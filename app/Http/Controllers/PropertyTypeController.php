<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PropertyType;
use App\Models\PropertyTypeTranslation;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_type = PropertyType::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_type = $property_type->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_types = $property_type->paginate(10);
    
        return view('backend.product.property_types.index', compact('property_types', 'sort_search'));
    }

    public function create()
    {
        $property_type = PropertyType::where('parent_id', 0)
            ->with('childrenProperties')
            ->get();

        return view('backend.product.property_types.create', compact('property_type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_types,slug|max:255',
        ]);

        $property_type = new PropertyType;
        $property_type->name = $request->name;
        $property_type->slug = $request->slug;
        $property_type->order_level = $request->order_level;
        $property_type->icon = $request->icon;
        $property_type->meta_description = $request->meta_description;
        $property_type->parent_id = $request->parent_id;
        $property_type->save();

        $property_type_translation = PropertyTypeTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'property_type_id' => $property_type->id]);
        $property_type_translation->name = $request->name;
        $property_type_translation->save();

        flash(translate('Property Type has been inserted successfully'))->success();
        return back();
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $module = PropertyType::findOrFail($id);
        $property_types = PropertyType::where('parent_id', 0)
            ->with('childrenProperties')
            ->orderBy('name','asc')
            ->get();

        return view('backend.product.property_types.edit', compact('lang', 'property_types', 'module'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|max:255|unique:property_types,slug,'.$id,
        ]);

        $property_type = PropertyType::findOrFail($id);

        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_type->name = $request->name;
        }
        
        $property_type->order_level = $request->order_level;
        $property_type->icon = $request->icon;
        $property_type->meta_description = $request->meta_description;
        $property_type->parent_id = $request->parent_id;
        $property_type->save();

        $property_type_translation = PropertyTypeTranslation::firstOrNew(['lang' => $request->lang, 'property_type_id' => $property_type->id]);
        $property_type_translation->name = $request->name;
        $property_type_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return back();

    }

    public function destroy($id)
    {
        $pp = Product::where('type_id',$id)->get();
        if(count($pp) > 0){
            flash(translate('Property Type Used SomeWhere'))->success();
            return back();
        }

        $property_type = PropertyType::findOrFail($id);
        $property_type->delete();

        flash(translate('Property Type has been deleted successfully'))->success();
        return back();
    }

   

}