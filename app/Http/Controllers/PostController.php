<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Ball;
use App\Models\FillBucket;
use Illuminate\Support\Facades\DB;
use Redirect;
use Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        $data1 = Bucket::all();
        $ball = Ball::all();
        return view('form',compact('data1','ball'));
        
    }
    public function storeData(Request $request)
    {

        $validatedData = $request->validate([ 'bucket_id' => 'required', 'ball_name' => 'required', // Add more validation rules for other fields 
    ]);
        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => $validatedData->errors()->first()], JsonResponse::HTTP_BAD_REQUEST);
        }
       $val = explode(',',$request->ball_name);
       $check  = Bucket::select('*')->where('bucket_name','=',$request->bucket_val)->first();
       $current = $check->remaining_volume-$val[1];
       if($check->remaining_volume >=$current){
        $insert = new FillBucket();
        $insert->bucket_id = $check->id;
        $insert->ball_id = $val[0];
        $insert->bucket_volume = $check->remaining_volume==0?$check->bucket_volume:$check->remaining_volume;
        $insert->bucket_volume_remains = $current;
        $insert->bucket_contain_cubic_inches = $val[1];
        $insert->ball_value =$val[1];
        $res = $insert->save();
        if($res){
                $update = Bucket::find($check->id);
                $update->remaining_volume = $insert->bucket_volume_remains;
                $update->save();
               $data1 = Bucket::all();
             $ball = Ball::all();
            return view('form',compact('data1','ball'));
        }
       }else{
        return response()->json(['message'=>'Bucket has no more space!']);
       }
       
        
    }

    function checkBucket(Request $req){
        $check  = Bucket::where('bucket_name','=',$req->bucket_name)->first();
        if($check){
            $vol = $check->remaining_volume==0?$check->bucket_volume:$check->remaining_volume;
            return response()->json(['message'=>'Bucket value already given','data'=>$vol]);
            // echo  "Bucket value already given";
        }else{
            $insert = new Bucket();
            $insert->bucket_name = $req->bucket_name;
            $insert->bucket_volume = $req->bucket_volume;
            $insert->bucket_volume_in_inches = 20;
            $insert->remaining_volume =     $req->bucket_volume;
            $res = $insert->save();
            // echo "Bucket Insert Successfuly!";
            return response()->json(['message'=>'Bucket Insert Successfuly!']);
        }
    }
    
}
