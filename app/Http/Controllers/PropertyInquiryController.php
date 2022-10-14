<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyInquiry;
use App\Models\PropertyInquiryTranslation;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Product;

class PropertyInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = PropertyInquiry::with(['property.user','user'])->orderBy('created_at', 'desc');

        if ($request->has('agent') && $request->agent != '') {
            $properties = Product::where('user_id',$request->agent)->get()->pluck('id')->toArray();
            $data = $data->whereIn('property_id',$properties);
        }

        if ($request->has('property') && $request->property != '') {
            $data = $data->where('property_id',$request->property);
        }

        if ($request->has('customer') && $request->customer != '') {
            $data = $data->where('agent_id',$request->customer);
        }

        if($request->has('count') && $request->count != '') {
            $data = $data->paginate($request->count);  
        }else{
            $data = $data->paginate(10); 
        }  

         $agents = User::where('user_type','seller')->orderBy('created_at', 'desc')->with('shop')->get();
         $properties = Product::all();
         $customers = User::where('user_type','customer')->orderBy('created_at', 'desc')->get();

        return view('backend.property.property_inquiries.index', compact('data','agents','properties','customers'));
    }


    public function create()
    {
 
    }

    public function store(Request $request)
    {
       
    }

    public function destroy($id)
    {
        
    }

    public function edit($id){

        $data = PropertyInquiry::findOrFail($id);
        return view('backend.property.property_inquiries.edit', compact('data'));
    }


    /*
     * Remove the specified resource from storage.
     */
    public function bulk(Request $request)
    {

        if($request->has('idz') && $request->has('action') && $request->has('value')){
            $idz = explode(',',$request->idz);    
            switch ($request->action) {
                case 'delete':

                    PropertyInquiry::whereIn('id',$idz)->delete();
                    return response()->json(['message' => translate('Records Deleted')],200);
                    break;

                default:
                break;
            }

        }

        return response()->json(['message' => translate('Error Found')],400);   
    }
    
}
