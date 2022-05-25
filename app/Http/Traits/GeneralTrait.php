<?php

namespace App\Http\Traits;
use Carbon\Carbon;

trait GeneralTrait {

    public function ResponseJson(bool $isSuccess, String $message, 
        $data = null,$statusCode = 200) {
            $payload = [
                "status"    => $isSuccess,
                "message"   => $message,
                "timestamps"=> Carbon::now(),
            ];

            if(!is_null($data)){
                $payload["data"] = $data;
            };

            return response()->json($payload, $statusCode);
    }

    public function ResponsePaginateJson(bool $isSuccess, String $message, 
        $limit, $next_url, $data = [],$statusCode = 200) {
            $payload = [
                "status"    => $isSuccess,
                "message"   => $message,
                "next_page" => $next_url,
                "timestamps"=> Carbon::now(),
            ];

            if(count($data) < $limit){
                $payload["next_page"]   = null;
            }

            if(!is_null($data)){
                $payload["data"] = $data;
            };

            return response()->json($payload, $statusCode);
    }

    public function ResponseJsonError(){
        return response()->json([
            "status"    => false,
            "message"   => CONFIG("statusmessage.SERVER_ERROR"),
            "timestamps"=> Carbon::now(),
        ], 500);
    }

}