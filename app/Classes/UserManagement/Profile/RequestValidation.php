<?php


namespace App\Classes\UserManagement\Profile;


use Illuminate\Support\Facades\Validator;

class RequestValidation
{
    public function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['bail', 'required', 'regex:/^(0){1}(9){1}[0-9]{9}+$/'],
        ], [
            'username.required' => 'شماره موبایل مورد نیاز است',
            'username.regex' => 'شماره موبایل معتبر نیاز است',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->getMessages();
            return ['error' => true, 'message' => $messages, 'username' => $request->username];
        } else {
            return ['error' => false, 'message' => '', 'username' => $request->username];
        }
    }
}
