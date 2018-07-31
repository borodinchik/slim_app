<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        var_dump($users);
        die();
        return $users;
    }
}