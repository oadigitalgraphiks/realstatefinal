<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyUnit;
use App\Models\PropertyUnitTranslation;
use Illuminate\Support\Str;

class PropertyUnitController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $property_units = PropertyUnit::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_units = $property_units->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_units = $property_units->paginate(5);
   
        return view('backend.product.property_units.index', compact('property_units', 'sort_search'));
    }

    public function create()
    {
        return view('backend.product.property_units.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_units,slug|max:255',
        ]);

        $property_unit = new PropertyUnit;
        $property_unit->name = $request->name;
        $property_unit->slug = $request->slug;
        $property_unit->shortname = $request->shortname;
        $property_unit->conversion = $request->conversion;
        $property_unit->icon = $request->icon;
        $property_unit->order_level = $request->order_level;
        $property_unit->save();

        $property_unit_translation = PropertyUnitTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_unit_id' => $property_unit->id
        ]);

        $property_unit_translation->name = $request->name;
        $property_unit_translation->shortname = $request->shortname;
        $property_unit_translation->save();

        flash(translate('Property Unit has been inserted successfully'))->success();
        return  back();
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_unit = PropertyUnit::findOrFail($id);
        return view('backend.product.property_units.edit', compact('lang', 'property_unit'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_units,slug',
        ]);

        $property_unit = PropertyUnit::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_unit->name = $request->name;
            $property_unit->shortname = $request->shortname;
        }
                
        $property_unit->slug = $request->slug;
        $property_unit->conversion = $request->conversion;
        $property_unit->order_level = $request->order_level;
        $property_unit->save();

        $property_unit_translation = PropertyUnitTranslation::firstOrNew(['lang' => $request->lang, 'property_unit_id' => $property_unit->id]);
        $property_unit_translation->name = $request->name;
        $property_unit_translation->shortname = $request->shortname; 
        $property_unit_translation->save();

        flash(translate('Property Unit has been updated successfully'))->success();
        return back();
    }

   

    public function destroy($id)
    {

        $property_units = PropertyUnit::findOrFail($id);
        $property_units->delete();
        flash(translate('Property Unit has been deleted successfully'))->success();
        return back();

    }
}
