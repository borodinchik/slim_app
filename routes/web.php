<?php

use App\Controllers\UserController;
use App\Controllers\TaskController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\PasswordController;


$app->post('/register', RegisterController::class . ':registerUser');
$app->post('/login', LoginController::class . ':signIn');

$app->get('/password/change', PasswordController::class . ':getChangePassword');
$app->post('/password/change', PasswordController::class . ':postChangePassword');


$app->group('/user', function ()
{
    $this->get('', UserController::class . ':index');
    $this->get('/{id}', UserController::class . ':showUserById');
    $this->put('/update/{id}', UserController::class . ':updateUser');
    $this->delete('/delete/{id}', UserController::class . ':deleteUser');
    $this->get('/{id}/tasks', UserController::class . ':getUserTasks');
});


$app->group('/task', function ()
{
    $this->get('', TaskController::class . ':getAllTasks');
    $this->get('/{id}', TaskController::class . ':getTaskById');
    $this->post('', TaskController::class . ':createNewTask');
    $this->put('/update/{id}', TaskController::class . ':update');
    $this->delete('/delete/{id}', TaskController::class . ':delete');
});
