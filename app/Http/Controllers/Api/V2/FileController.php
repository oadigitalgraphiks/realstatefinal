<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Storage;
use Validator;

class FileController extends Controller
{

    // any  base 64 image through uploader
    public function imageUpload(Request $request){

        $validator = Validator::make($request->all(), [
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                     'message' => 'Validation Failed',
                     'errors' => $validator->messages(),
            ],401);
        }

        try {

            $image = $request->image;
            $request->filename;
            $orignalName = $image->getClientOriginalName();
            $extension = strtolower($request->image->extension());
            $size = $request->file('image')->getSize();
            $dir = public_path('uploads/all');
            $newFileName = rand(10000000000, 9999999999) . date("YmdHis") . "." . $extension;
            $full_path = $image->move($dir,$newFileName);
            
            $upload = Upload::create([
                "file_original_name" => $orignalName,
                "extension" => $extension,
                "file_name" => "uploads/all/".$newFileName,
                "user_id" => $request->user()->id,
                "type" => 'image',
                "file_size" => $size,
            ]);


            return response()->json([
                'result' => true,
                'message' => translate("Image updated"),
                'path' => api_asset($upload->id),
                'upload_id' => $upload->id
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
                'path' => "",
                'upload_id' => 0
            ]);

        }

    }


    public function get(Request $request, $id)
    {

        $user = $request->user();
        $upload = Upload::find($id);
       
        if($upload == null){
            return response()->json([
                "message" => "File Not Found" ,
            ],400);
        }

        if($user->id != $upload->user_id){
            return response()->json([
                "message" => "Unauthorized" ,
            ],400);
        }

        if(! File::exists(public_path($upload->file_name))){
            return response()->json([
                "message" => "File Not Found" ,
            ],400);
        }


        return response()->json([
            "message" => "File Get Successfully" ,
            "data" => $upload,
        ],200);

    }

    public function delete(Request $request,$id)
    {
        $user = $request->user();
        $upload = Upload::find($id);
       
        if($upload == null){
            return response()->json([
                "message" => "File Not Found" ,
            ],400);
        }

        if($user->id != $upload->user_id){
            return response()->json([
                "message" => "Unauthorized" ,
            ],400);
        }

        if(! File::exists(public_path($upload->file_name))){
            return response()->json([
                "message" => "File Not Found" ,
            ],400);
        }

        if(! File::delete(public_path($upload->file_name))){
            return response()->json([
                "message" => "File Not Deleted" ,
            ],400); 
        }
        
        $upload->delete();

        return response()->json([
            "message" => "File Successfully Deleted",
            "data" => $id,
        ],200);
    
    }


    public function all(Request $request)
    {

        $user = $request->user();
        $uploads = Upload::where('user_id',$user->id)->get();
        
        return response()->json([
            "message" => "Get Files Successfully" ,
            "total" => count($uploads),
            "data" => $uploads,
        ]);
    }

    

}

