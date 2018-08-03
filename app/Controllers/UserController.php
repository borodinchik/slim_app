<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Pagination;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index($request, $response)
    {
        $users = User::paginate(10);
        
        return $response->withJson($users, 200);
    }

    public function showUserById($request, $response, $args)
    {
        $userById = User::find($args['id']);

        return $response->withJson($userById, 200);
    }
    

    public function updateUser($request, $response, $args)
    {
        $user = User::find($args['id'])->first();

        $user->update($request->getParams());

        return $response->withJson($user, 201);
    }

    public function deleteUser($request, $response, $args)
    {
        $user = User::find($args['id'])->first();
        $user->delete();

        return $response->withJson(null, 204);
    }

    public function getUserTasks($request, $response, $args)
    {
        $tasks = User::with('tasks')->where('id', $args['id'])->first();
        if (!empty($tasks['password']))
        {
            unset($tasks['password']);
        }

        return $response->withJson($tasks, 200);
    }
}