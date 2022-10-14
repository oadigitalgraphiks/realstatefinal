<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCondition;
use App\Models\PropertyConditionTranslation;
use Illuminate\Support\Str;

class PropertyConditionController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_conditions = PropertyCondition::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_conditions = $property_conditions->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_conditions = $property_conditions->paginate(10);
        return view('backend.product.property_conditions.index', compact('property_conditions', 'sort_search'));
    }

    public function create()
    {
        return view('backend.product.property_conditions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_conditions,slug',
        ]);

        $property_condition = new PropertyCondition;
        $property_condition->name = $request->name;
        $property_condition->slug = $request->slug;
        $property_condition->save();

        $property_condition_translation = PropertyConditionTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_condition_id' => $property_condition->id
        ]);

        $property_condition_translation->name = $request->name;
        $property_condition_translation->save();

        flash(translate('Property condition has been inserted successfully'))->success();
        return redirect()->route('property_conditions.index');
    }

   

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_condition = PropertyCondition::findOrFail($id);
        return view('backend.product.property_conditions.edit', compact('lang', 'property_condition'));
    }


    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_conditions,slug,'.$id,
        ]);

        $property_condition = PropertyCondition::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_condition->name = $request->name;
        }
        $property_condition->slug = $request->slug;
        $property_condition->save();

        $property_condition_translation = PropertyConditionTranslation::firstOrNew(['lang' => $request->lang, 'property_condition_id' => $property_condition->id]);
        $property_condition_translation->name = $request->name;
        $property_condition_translation->lang = $request->lang; 
        $property_condition_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return back();
    }

    

    public function destroy($id)
    {
        $property_conditions = PropertyCondition::findOrFail($id);
        $property_conditions->delete();

        flash(translate('Property condition has been deleted successfully'))->success();
        return redirect()->route('property_conditions.index');

    }
}
