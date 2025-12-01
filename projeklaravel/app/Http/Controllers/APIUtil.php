<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class APIUtil extends Controller
{
    //

    public static function sendResponse($data, $message){
        $response = [
            'success'=>true,
            'data'=>$data,
            'message'=>$message
        ];
        return response()->json($response, 200);
    }

    public static function sendError($errorData, $message = [], $code=404){
        $response = [
            'success'=>false,
            'data'=>$errorData
        ];

        if(!isEmpty($message)){
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }
}
