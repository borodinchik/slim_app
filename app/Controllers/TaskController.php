<?php

namespace App\Controllers;

use App\Models\Task;
use Illuminate\Pagination;
use Illuminate\Pagination\Paginator;
use Respect\Validation\Validator as v;


class TaskController extends Controller
{
    public function getAllTasks($request, $response)
    {
        $tasks = Task::paginate(10);

        return $response->withJson($tasks, 200);
    }

    public function createNewTask($request, $response)
    {
        $validation = $this->validator->validate($request,
            [
                'title' => v::notEmpty()->alpha(),
                'body' => v::notEmpty()->alpha(),
            ]);

        if ($validation->failed())
        {
            return $response->withJson($validation);
        }
        
        $input = $request->getParams();
        
        $task = new Task();
        $task->title = $input['title'];
        $task->body = $input['body'];
        $task->save();
        
        return $response->withJson($task, 201);

    }

    public function getTaskById($request, $response, $args)
    {
        $taskById = Task::where('id', $args['id'])->first();
        
        return $response->withJson($taskById, 200);
    }

    public function update($request, $response, $args)
    {
        $task = Task::find($args['id'])->first();
        $task->update($request->getParams());

        return $response->withJson($task, 201);
    }

    public function delete($request, $response, $args)
    {
        $task = Task::find($args['id']);
        $task->delete();

        return $response->withJson(null, 204);


    }
}