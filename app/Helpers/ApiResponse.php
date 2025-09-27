<?php

namespace App\Helpers;

class ApiResponse
{
    public static function apiResponse($message,$data=[],$status=200){
        return response()->json([
            'message'=>$message,
            'status'=>$status,
            'data'=>$data
        ]);
    }
}
