<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyTourType;
use App\Models\PropertyTourTypeTranslation;


class PropertyTourTypeController extends Controller
{

    /*
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $data = PropertyTourType::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $data = $data->where('name', 'like', '%'.$sort_search.'%');
        }

        $data = $data->paginate(10);
        return view('backend.product.property_tour_types.index', compact('data', 'sort_search'));
    }


    public function create()
    {
        return view('backend.product.property_tour_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_tour_types,slug',
        ]);

        $data = new PropertyTourType;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->logo = $request->logo;
        $data->save();

        $translation = PropertyTourTypeTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_tour_type_id' => $data->id
        ]);

        $translation->name = $request->name;
        $translation->save();

        flash(translate('Property Bath has been inserted successfully'))->success();
        return redirect()->route('property_tour_types.index');
    }

   
    public function edit(Request $request, $id){

        $lang = $request->lang;
        $data = PropertyTourType::findOrFail($id);
        return view('backend.product.property_tour_types.edit', compact('lang', 'data'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_tour_types,slug,'.$id,
        ]);

        $data = PropertyTourType::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
            $data->logo = $request->logo;
        }
        $data->slug = $request->slug;
        $data->save();

        $translation = PropertyTourTypeTranslation::firstOrNew(['lang' => $request->lang, 'property_tour_type_id' => $data->id]);
        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property Tour Type has been updated successfully'))->success();
        return back();
    }

    public function destroy($id)
    {

        $data = PropertyTourType::findOrFail($id);
        $data->delete();

        flash(translate('Property Tour Type has been deleted successfully'))->success();
        return back();
    }

}