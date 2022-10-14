<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyPurpose;
use App\Models\PropertyPurposeTranslation;
use App\Models\Product;
use Illuminate\Support\Str;

class PropertyPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $property_purposes = PropertyPurpose::orderBy('id', 'desc');
        
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_purposes = $property_purposes->where('name', 'like', '%'.$sort_search.'%');
        }

        $property_purposes = $property_purposes->paginate(10);
        return view('backend.product.property_purposes.index', compact('property_purposes', 'sort_search'));
    }

    public function create()
    {

        $property_purposes = PropertyPurpose::where('parent_id', 0)->with('children')->get();
        return view('backend.product.property_purposes.create', compact('property_purposes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_purposes,slug|max:255',
        ]);

        $property_purpose = new PropertyPurpose;
        $property_purpose->name = $request->name;
        $property_purpose->slug = $request->slug;
        $property_purpose->order_level = $request->order_level;
        $property_purpose->icon = $request->icon;
        $property_purpose->meta_description = $request->meta_description;
        $property_purpose->parent_id = $request->parent_id;
        $property_purpose->save();

        $property_purpose_translation = PropertyPurposeTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_purpose_id' => $property_purpose->id
        ]);

        $property_purpose_translation->name = $request->name;
        $property_purpose_translation->save();

        flash(translate('Property Purpose has been inserted successfully'))->success();
        return redirect()->route('property_purposes.index');
    }


    public function edit(Request $request, $id)
    {

        $lang = $request->lang;
        $property_purpose = PropertyPurpose::findOrFail($id);
        $property_purposes = PropertyPurpose::where('parent_id', 0)
            ->with('children')
            ->orderBy('name','asc')
            ->get();

        return view('backend.product.property_purposes.edit', compact('lang', 'property_purpose', 'property_purposes'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_purposes,slug,'.$id,
        ]);

        $property_purpose = PropertyPurpose::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_purpose->name = $request->name;
        }

        $property_purpose->slug = $request->slug;
        $property_purpose->order_level = $request->order_level;
        $property_purpose->icon = $request->icon;
        $property_purpose->meta_description = $request->meta_description;
        $property_purpose->parent_id = $request->parent_id;
        $property_purpose->save();

        $property_purpose_translation = PropertyPurposeTranslation::firstOrNew(['lang' => $request->lang, 'property_purpose_id' => $property_purpose->id]);
        $property_purpose_translation->name = $request->name;
        $property_purpose_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return back();

    }


    public function destroy($id)
    {

        $product = Product::where('type_id',$id)->get();   
        if(count($product)){
            flash(translate('This Property Purpose Used Somewhere'))->success();
            return back();
        }

        $property_purposes = PropertyPurpose::findOrFail($id);
        $property_purposes->delete();

        flash(translate('Property Purpose has been deleted successfully'))->success();
        return back();
    }

    
}