<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App;
use App\Models\PropertyCity;
use App\Models\PropertyCityTranslation;

class CityController extends Controller
{


    
    /**
     * Display a listing of the resource
     */
    public function all_cities(Request $request)
    {
        if($request->has('id')){

            $search = $request->q;
            $id = intval($request->id);
            $data = PropertyCity::where('state_id',$id)->select("id","name")->where('name','LIKE',"%$search%")->get();
           return response()->json($data,200);
        }
    }
    

    /**
     * Display a listing of the resource
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $search = $request->q;
            $data = PropertyCity::select("id","name")->where('name','LIKE',"%$search%")->limit(5)->get();
            return response()->json($data,200);
         }

        $sort = $request->sort;
        $data = PropertyCity::orderBy('status', 'desc');
        if($request->sort) {
            $data = $data->where('name', 'like', "%$sort%");
        }
        $data = $data->paginate(15);

        return view('backend.location.cities.index', compact('data', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('backend.location.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'orignal_slug' => 'required|unique:property_cities,orignal_slug',
        ]);

        $data = new PropertyCity;
        $data->name = $request->name;
        $data->orignal_slug = $request->orignal_slug;
        $data->state_id = $request->state_id;
        $data->code = $request->code;
        $data->icon = $request->icon;
        $data->featured = $request->featured;
        $data->status = $request->status;
        $data->lat = $request->lat;
        $data->lon = $request->lon;
        $data->save();

        $translation = PropertyCityTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'ref' => $data->id]);
        $translation->name = $request->name;
        $translation->save();

        flash(translate('City has been inserted successfully'))->success();
        return redirect()->route('property_cities.index');
    }

   

    public function edit(Request $request, $id){

        $lang = env("DEFAULT_LANGUAGE");
        if($request->has('lang')){
          $lang = $request->lang;
        }

        $data = PropertyCity::findOrFail($id);
        return view('backend.location.cities.edit', compact('lang', 'data'));
    }


    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'orignal_slug' => 'required|unique:property_cities,orignal_slug,'.$id,
        ]);

        $data = PropertyCity::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
        }

        $data->orignal_slug = $request->orignal_slug;
        $data->code = $request->code;
        $data->icon = $request->icon;
        $data->status = $request->status;
        $data->featured = $request->featured;
        $data->state_id = $request->state_id;
        $data->lat = $request->lat;
        $data->lon = $request->lon;
        $data->save();

        $translation = PropertyCityTranslation::firstOrNew(['lang' => $request->lang, 'ref' => $data->id]);
        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property City has been Updated successfully'))->success();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = PropertyCity::findOrFail($id);
        $data->delete();

        flash(translate('Property City has been deleted successfully'))->success();
        return redirect()->route('property_cities.index');
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
                    PropertyCity::whereIn('id',$idz)->update(['status' => $request->value]);
                    return response()->json(['message' => translate('Updated')],200);
                    break;
                
                case 'featured':   
                    PropertyCity::whereIn('id',$idz)->update(['featured' => $request->value]);
                    return response()->json(['message' => translate('Updated')],200);
                    break;    

                default:
                break;
            }

        }

        return response()->json(['message' => translate('Error Found')],400);   
    }

   
}
