<?php

namespace App\Http\Controllers\Api;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code'      => 202,
            'status'    => 'success',
            'message'   => null
        ]
    ];


    public static function success($message = null)
    {
        self::$response['meta']['message'] = $message;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($message = null, $code = null)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;


        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
