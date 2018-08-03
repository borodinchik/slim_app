<?php

namespace App\Controllers\Auth;

use App\Models\User;

use App\Controllers\Controller;
use Respect\Validation\Validator as v;


class RegisterController extends Controller
{
    public function registerUser($request, $response, $args)
    {
        $validator = $this->validator->validate($request,
            [
                'name'  => v::notEmpty()->alpha(),
                'email' => v::noWhitespace()->notEmpty(),
                'password' => v::noWhitespace()->notEmpty(),
            ]);

        if ($validator->failed())
        {
            return $response->withJson($validator);
        }

        $input = $request->getParams();

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = password_hash($input['password'], PASSWORD_DEFAULT);
        $user->save();
        return $response->withJson($user, 201);
    }
}