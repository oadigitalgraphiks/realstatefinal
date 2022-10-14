<?php

namespace App\Http\Controllers\Api\V2;

use Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\PropertySearch;
use Validator;

class PropertySearchController extends Controller {

     /*
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();
        $searches = PropertySearch::where('user_id',$user->id)->get();

        return response()->json([
            "message" => "Get Searches Successfully",
            "data" => $searches
        ],200);
    }


    /*
     * Display a listing of the resource.
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'lng' => 'required|string',
            'lat' => 'required|string',
            'bonds' => 'required|string',
            'image' => 'required|string'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Failed',
                'data' => ['errors' => $validator->messages()],
            ],401);
        }

        $search = PropertySearch::create([
            'lng' => $request->lng,
            'lat' => $request->lat,
            'bonds' => $request->bonds,
            'image' => $request->image,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Created',
            'data' => $search,
        ],200);

    }


      /*
     * Display a listing of the resource.
     */
    public function bulk_store(Request $request){

        if($request->has('data') && is_array($request->data)){

            $data = [];
            foreach ($request->data as $item) {
                 array_push($data,[
                    'lng' => $item['lng'],
                    'lat' => $item['lat'],
                    'bonds' => $item['bonds'],
                    'image' => $item['image'],
                    'user_id' => $request->user()->id,
                 ]);  
            }

           $searches = PropertySearch::insert($data);

            return response()->json([
                'message' => 'Created',
                'data' => $searches,
            ],200);

        }

        return response()->json([
            'message' => 'Invalid Data',
        ],401);
        
    }


       /*
     * Display a listing of the resource.
     */
    public function find($id){

        $searches = PropertySearch::find($id); 
        if($searches == null ){

            return response()->json([
                'message' => 'Not Found',
            ],401);
        }

        return response()->json([
            'message' => 'Get Successfully',
            'data' => $searches,
        ],200);
        
    }

    
       /*
     * Display a listing of the resource.
     */
    public function delete($id){

        $searches = PropertySearch::find($id); 
        if($searches == null ){
            return response()->json([
                'message' => 'Not Found',
            ],401);
        }

        $searches->delete();

        return response()->json([
            'message' => 'Deleted',
        ],200);
        
    }

    /*
     * Display a listing of the resource.
     */
    public function delete_bulk($id){

        try {

            $idz = explode(',',$id);
            PropertySearch::whereIn('id',$idz)->delete();
            return response()->json([
                'message' => 'Deleted',
            ],200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Not Deleted',
            ],401);
        }

    }

    



    /*
     * Display a listing of the resource.
     */
    public function update(Request $request,$id){

        $searches = PropertySearch::find($id); 
        if($searches == null ){
            return response()->json([
                'message' => 'Not Found',
            ],401);
        }

        $validator = Validator::make($request->all(), [
            'lng' => 'required|string',
            'lat' => 'required|string',
            'bonds' => 'required|string',
            'image' => 'required|string'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Failed',
                'data' => ['errors' => $validator->messages()],
            ],401);
        }

        $searches->lng = $request->lng;
        $searches->lat = $request->lat;
        $searches->bonds = $request->bonds;
        $searches->image = $request->image;
        $searches->save();
    
        return response()->json([
            'message' => 'Updated',
            'data' => $searches,
        ],200);
        
    }


    






 

}