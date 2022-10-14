<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyAmenity;
use App\Models\PropertyAmenityTranslation;

class PropertyAmenityController extends Controller
{

    /*
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $data = PropertyAmenity::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $data = $data->where('name', 'like', '%'.$sort_search.'%');
        }

        $data = $data->paginate(10);
        return view('backend.product.property_amenities.index', compact('data', 'sort_search'));
    }


    public function create()
    {
        return view('backend.product.property_amenities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_amenities,slug',
        ]);

        $data = new PropertyAmenity;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->logo = $request->logo;
        $data->save();

        $translation = PropertyAmenityTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_amenity_id' => $data->id
        ]);

        $translation->name = $request->name;
        $translation->save();

        flash(translate('Property Aminty has been inserted successfully'))->success();
        return redirect()->route('property_amenities.index');
    }

   
    public function edit(Request $request, $id){

        $lang = $request->lang;
        $data = PropertyAmenity::findOrFail($id);
        return view('backend.product.property_amenities.edit', compact('lang', 'data'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_amenities,slug,'.$id,
        ]);

        $data = PropertyAmenity::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
            $data->logo = $request->logo;
        }
        
        $data->slug = $request->slug;
        $data->save();

        $translation = PropertyAmenityTranslation::firstOrNew(['lang' => $request->lang, 'property_amenity_id' => $data->id]);
        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property Amenity has been updated successfully'))->success();
        return back();
    }

    public function destroy($id)
    {
        $data = PropertyAmenity::findOrFail($id);
        $data->delete();
        flash(translate('Property Tour Type has been deleted successfully'))->success();
        return back();
    }

}