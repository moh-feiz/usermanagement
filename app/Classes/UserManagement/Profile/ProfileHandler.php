<?php


namespace App\Classes\UserManagement\Profile;


use App\Services\UserService;

class ProfileHandler
{

    public function validation($request)
    {
        $request_validation = new RequestValidation;
        return $request_validation->validation($request);
    }

    public function profileHandler($request)
    {
        $result = new \stdClass();
        $user_info = new \stdClass();
        $request_validation = $this->validation($request);
        if ($request_validation['error'] == false) {
            $user_service = new UserService;
            $user = $user_service->checkUserExist($request->username);
            if ($user) {
                $user_info->username = $user->username;
                $user_info->email = $user->email;
                $result->user_info = $user_info;
                return ['error' => false, 'message' => $result, 'username' => $request->username];
            } else {
                return ['error' => true, 'message' => 'همچین کاربری موجود نیست', 'username' => $request->username];
            }

        } else {
            return $request_validation;
        }
    }
}
