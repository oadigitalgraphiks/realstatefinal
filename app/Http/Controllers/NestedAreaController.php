<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App;
use App\Models\PropertyNestedArea;
use App\Models\PropertyNestedAreaTranslation;

class NestedAreaController extends Controller
{

    /*
     * Display a listing of the resource
     */
    public function all_nested_areas(Request $request)
    {
        if($request->has('id')){
           $id = $request->id;
           $data = PropertyNestedArea::where('parent',$id)->get();
           return response()->json($data,200);
        }
    }

    
    /*
     * Display a listing of the resource
     */
    public function index(Request $request)
    {
        $sort = $request->sort;
        $data = PropertyNestedArea::orderBy('status', 'desc');
        if($request->sort) {
            $data = $data->where('name', 'like', "%$sort%");
        }
        $data = $data->paginate(15);

        return view('backend.location.nested_areas.index', compact('data', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.location.nested_areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'orignal_slug' => 'required|unique:property_nested_areas,orignal_slug',
        ]);

        $data = new PropertyNestedArea;
        $data->name = $request->name;
        $data->orignal_slug = $request->orignal_slug;
        $data->parent = $request->area_id;
        $data->code = $request->code;
        $data->icon = $request->icon;
        $data->featured = $request->featured;
        $data->status = $request->status;
        $data->lat = $request->lat;
        $data->lon = $request->lon;
        $data->save();

        $translation = PropertyNestedAreaTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'ref' => $data->id]);
        $translation->name = $request->name;
        $translation->save();

        flash(translate('Nested Area has been inserted successfully'))->success();
        return redirect()->route('property_nested_areas.index');
    }

   
    public function edit(Request $request, $id)
    {

        $lang = env("DEFAULT_LANGUAGE");
        if($request->has('lang')){
          $lang = $request->lang;
        }

        $data = PropertyNestedArea::findOrFail($id);
      
        return view('backend.location.nested_areas.edit', compact('lang', 'data'));
    }


    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'orignal_slug' => 'required|unique:property_nested_areas,orignal_slug,'.$id,
        ]);

        $data = PropertyNestedArea::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
        }

        $data->orignal_slug = $request->orignal_slug;
        $data->code = $request->code;
        $data->icon = $request->icon;
        $data->status = $request->status;
        $data->lat = $request->lat;
        $data->lon = $request->lon;
        $data->featured = $request->featured;
        // $data->parent = $request->parent;
        $data->parent = $request->area_id;
        $data->save();

        $translation = PropertyNestedAreaTranslation::firstOrNew([
            'lang' => $request->lang, 
            'ref' => $data->id
        ]);
        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property Nested Areas has been Updated successfully'))->success();
        return back();

    }


    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = PropertyNestedArea::findOrFail($id);
        $data->delete();

        flash(translate('Property Nested Area has been deleted successfully'))->success();
        return back();
    }

    
     /*
     * Remove the specified resource from storage.
     */
    public function bulk(Request $request)
    {

        if($request->has('idz') && $request->has('action') && $request->has('value')){
            $idz = explode(',',$request->idz);    
            switch ($request->action) {
            
                case 'status': 
                    PropertyNestedArea::whereIn('id',$idz)->update(['status' => $request->value]);
                    return response()->json(['message' => translate('Updated')],200);
                    break;
                
                case 'featured':   
                    PropertyNestedArea::whereIn('id',$idz)->update(['featured' => $request->value]);
                    return response()->json(['message' => translate('Updated')],200);
                    break;    

                default:
                break;
            }

        }

        return response()->json(['message' => translate('Error Found')],400);   
    }

   
}