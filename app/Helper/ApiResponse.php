<?php

namespace App\Helper;

class ApiResponse
{
    static public function reponseFn($code = 200, $message = null, $data = null)
    {
        $respons = [
            'status' => $code,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($respons, $code);
    }
}
