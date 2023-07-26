<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function __uploadImage($image, $path = null)
    {
        if ($path === null)
            $path = public_path('uploads');
        $imageName = uniqid() . time() . '.' . $image->getClientOriginalExtension();
        $image->move($path, $imageName);
        //	$image->response()->file(storage_path($path));
        return $imageName;
    }

    public static function validateAttributes($request, $formType = 'GET', $attributeValidate = [], $attributes = [], $checkVariableCount = true)
    {
        $headers = getallheaders();
        if ($request->method() != $formType) {
            return self::error('This method is not allowed.', 409);
        }

        $params = [];
        if (isset($headers['client_id']) && isset($headers['client_secret'])) :
            $params['client_id'] = $headers['client_id'];
            $params['client_secret'] = $headers['client_secret'];
        endif;

        foreach ($attributes as $attribute) :
            $params[$attribute] = $request->$attribute;
        endforeach;

        if ($checkVariableCount === true) :
            if (count($attributes) != count($request->all())) :
                return self::error('Please fill required parameters only.', 409);
            endif;
        endif;
        $validator = Validator::make($params, $attributeValidate);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            foreach ($messages->keys() as $k => $key) {
                $errors = $messages->get($key)['0'];
            }
            return self::error($messages, 422, false);
        }
        return false;
    }
    public static function error($message, $errorCode = 422, $messageIndex = false)
    {
        return response()->json(['status' => false, 'code' => $errorCode, 'data' => (object) [], 'error' => $message], $errorCode);
    }
    public static function success($data, $code = 200, $returnType = 'object')
    {
        if ($returnType == 'array')
            $data = (array) $data;
        elseif ($returnType == 'data')
            $data = $data;
        else
            $data = (object) $data;
        return response()->json(['status' => true, 'code' => $code, 'data' => $data], $code);
    }
    
}
