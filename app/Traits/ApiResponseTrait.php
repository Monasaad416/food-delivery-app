<?php

namespace App\Traits;

trait ApiResponseTrait {
    public function apiResponse($status,$msg,$data=null){
        return response()->json([
            'status' =>$status,
            'messages' => $msg,
            'data' => $data,
        ]);
    }

}



