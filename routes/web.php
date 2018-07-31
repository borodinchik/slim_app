<?php

use App\Controllers\UserController;

$app->get('/', UserController::class . ":index");