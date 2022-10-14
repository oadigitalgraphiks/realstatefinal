<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyBath;
use App\Models\PropertyBathTranslation;
use Illuminate\Support\Str;

class PropertyBathController extends Controller
{

    /*
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $data = PropertyBath::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $data = $data->where('name', 'like', '%'.$sort_search.'%');
        }

        $data = $data->paginate(10);
        return view('backend.product.property_baths.index', compact('data', 'sort_search'));
    }


    public function create()
    {
        return view('backend.product.property_baths.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_baths,slug',
        ]);

        $data = new PropertyBath;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->save();

        $translation = PropertyBathTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_bath_id' => $data->id
        ]);

        $translation->name = $request->name;
        $translation->save();

        flash(translate('Property Bath has been inserted successfully'))->success();
        return redirect()->route('property_baths.index');
    }

   
    public function edit(Request $request, $id){

        $lang = $request->lang;
        $data = PropertyBath::findOrFail($id);
        return view('backend.product.property_baths.edit', compact('lang', 'data'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_baths,slug,'.$id,
        ]);

        $data = PropertyBath::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
        }
        $data->slug = $request->slug;
        $data->save();

        $translation = PropertyBathTranslation::firstOrNew(['lang' => $request->lang, 'property_bath_id' => $data->id]);
        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property Bath has been updated successfully'))->success();
        return back();
    }

    

    public function destroy($id)
    {

        $data = PropertyBath::findOrFail($id);
        $data->delete();

        flash(translate('Property Bath has been deleted successfully'))->success();
        return back();
    }

}
