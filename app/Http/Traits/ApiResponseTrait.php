<?php

namespace App\Http\Traits;

trait ApiResponseTrait{

    /**
     * [
     *  code => default 200 and dataType is int.
     *  message => default null and dataType is String.
     *  errors => default null and dataType is Array.
     *  data => default null and dataType id Array
     * ]
     */


    public function apiResponse($code = 200, $message , $errors = null, $data = null){

        $array = [
            'status' => $code,
            'message' => $message,

        ];
        if(is_null($data) && !is_null($errors)){
            $array['errors'] = $errors;
        }elseif(is_null($errors) && !is_null($data)){
            $array['data'] = $data;
        }

        return response($array , $code);
    }

    protected function handleError(\Exception $exception)
    {
        // Log the exception
        \Log::error($exception);

        // You can add custom logic here to handle different types of exceptions
        // For now, a generic error response is returned
        return response()->json([
            'status' => 500,
            'message' => 'An error occurred. Please try again later.',
        ], 500);
    }


}
