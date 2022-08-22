<?php

namespace App\Helper;

class Respond {

    public static function success($message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'status'    => 'success',
            'message'   => $message,
            'data'      => $data,
        ], $statusCode);
    }

    public static function failed($statusCode,  $status = 'failed', $message = 'failed')
    {
        return response()->json([
            'status'    => $status,
            'message'   => $message
        ], $statusCode);
    }
}