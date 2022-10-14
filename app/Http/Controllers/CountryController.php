<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCountry;
use App\Models\PropertyCountryTranslation;
use App;



class CountryController extends Controller
{

    /**
     * Display a listing of the resource
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $search = $request->q;
           $data = PropertyCountry::select("id","name")->where('name','LIKE',"%$search%")->get();
           return response()->json($data,200);
        }

        $sort_country = $request->sort_country;
        $data = PropertyCountry::orderBy('status', 'desc');
        if($request->sort_country) {
            $data = $data->where('name', 'like', "%$sort_country%");
        }
        $data = $data->paginate(15);
        return view('backend.location.countries.index', compact('data', 'sort_country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = PropertyCountry::all();
        return view('backend.location.countries.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_countries,slug',
        ]);

        $data = new PropertyCountry;
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->code = $request->code;
        $data->icon = $request->icon;
        $data->lat = $request->lat;
        $data->lon = $request->lon;
        $data->featured = $request->featured;
        $data->status = $request->status;
        $data->save();

        $translation = PropertyCountryTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'ref' => $data->id]);
        $translation->name = $request->name;
        $translation->save();

        flash(translate('Country has been inserted successfully'))->success();
        return redirect()->route('property_countries.index');
    }

   

    public function edit(Request $request, $id){

        $lang = env("DEFAULT_LANGUAGE");
        if($request->has('lang')){
          $lang = $request->lang;
        }
        
        $data = PropertyCountry::findOrFail($id);
        return view('backend.location.countries.edit', compact('lang', 'data'));
    }


    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:property_countries,slug,'.$id,
        ]);

        $data = PropertyCountry::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $data->name = $request->name;
        }

        $data->slug = $request->slug;
        $data->code = $request->code;
        $data->icon = $request->icon;
        $data->lat = $request->lat;
        $data->lon = $request->lon;
        $data->status = $request->status;
        $data->featured = $request->featured;
        $data->save();

        $translation = PropertyCountryTranslation::firstOrNew(['lang' => $request->lang, 'ref' => $data->id]);
        $translation->name = $request->name;
        $translation->lang = $request->lang; 
        $translation->save();

        flash(translate('Property Country has been Updated successfully'))->success();
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
        
        $property_country = PropertyCountry::findOrFail($id);

        $property_country->delete();

        flash(translate('Property Country has been deleted successfully'))->success();
        return redirect()->route('property_countries.index');
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
                    PropertyCountry::whereIn('id',$idz)->update(['status' => $request->value]);
                    return response()->json(['message' => translate('Updated')],200);
                    break;
                
                case 'featured':   
                    PropertyCountry::whereIn('id',$idz)->update(['featured' => $request->value]);
                    return response()->json(['message' => translate('Updated')],200);
                    break;    

                default:
                break;
            }

        }

        return response()->json(['message' => translate('Error Found')],400);   
    }

   
}
