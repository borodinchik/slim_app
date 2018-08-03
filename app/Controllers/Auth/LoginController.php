<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;



class LoginController extends Controller
{
    public function signIn($request, $response)
    {
        $auth =  $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if ($auth)
        {
            return $response->withJson([
                'data' => 'You Sign In!'
            ], 200);

        }else{

            return $response->withJson([
                'error' => 'Unauthenticated!'
            ], 401);
        }
        
    }
}