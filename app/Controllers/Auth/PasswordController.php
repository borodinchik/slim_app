<?php

namespace App\Controllers\Auth;

use App\Models\User;

use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
    public function getChangePassword($request, $response)
    {
        return $response;
    }

    public function postChangePassword($request, $response)
    {
        $pass = $this->auth->user->password;
        dd($pass);
        $validation = $this->validator->validate($request,
            [
                'password_old' => v::noWhitespace()->notEmpty()
                    ->matchesPassword($this->auth->user->password),

                'password' => v::noWhitespace()->notEmpty(),
            ]);


        if ($validation->failed())
        {
            return $response->withJson($validation);
        }


        $newPassword = $this->auth->user->setPassword($request->getParam('password'));
        dd($newPassword);
        return $response->withJson($newPassword, 201);
    }

}