<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     *
     * Success response method.
     * @return Http\Response
     *
    */
    public function sendResponse($messge,$result=null){
        if($result !=null){
            $response = [
                'success' => true,
                'message' => $messge,
                'data'    => $result
            ];
        } else {

            $response = [
                'success' => true,
                'message' => $messge
            ];
        }
        return response()->json($response,200);
    }

    /**
     *
     * return error method.
     * @return Http\Response
     *
    */
    public function sendError($error,$errorMessage=[],$code=500){
       
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessage)){

            $response['data'] = $errorMessage;
        }
        return response()->json($response,$code);
    }
}
