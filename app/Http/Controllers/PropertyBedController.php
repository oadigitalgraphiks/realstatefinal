<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyBed;
use App\Models\PropertyBedTranslation;
use Illuminate\Support\Str;

class PropertyBedController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_beds = PropertyBed::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_beds = $property_beds->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_beds = $property_beds->paginate(10);
        return view('backend.product.property_beds.index', compact('property_beds', 'sort_search'));
    }

    public function create()
    {
        return view('backend.product.property_beds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_beds,slug',
        ]);

        $property_bed = new PropertyBed;
        $property_bed->name = $request->name;
        $property_bed->slug = $request->slug;
        $property_bed->save();

        $property_bed_translation = PropertyBedTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_bed_id' => $property_bed->id
        ]);

        $property_bed_translation->name = $request->name;
        $property_bed_translation->save();

        flash(translate('Property Bed has been inserted successfully'))->success();
        return redirect()->route('property_beds.index');
    }

   

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_bed = PropertyBed::findOrFail($id);
        return view('backend.product.property_beds.edit', compact('lang', 'property_bed'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_beds,slug,'.$id,
        ]);

        $data = PropertyBed::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
        }
        $data->slug = $request->slug;
        $data->save();

        $translation = PropertyBedTranslation::firstOrNew(['lang' => $request->lang, 'property_bed_id' => $data->id]);

        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property Bed has been updated successfully'))->success();
        return back();
    }

    

    public function destroy($id)
    {
        $data = PropertyBed::findOrFail($id);
        $data->delete();

        flash(translate('Property Bed Has Been Deleted Successfully'))->success();
        return back();

    }
}
