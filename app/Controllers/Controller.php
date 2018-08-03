<?php

namespace App\Controllers;

use Interop\Container\ContainerInterface;

abstract class Controller
{
    protected $c;

    protected $validator;
    
    protected $auth;

    public function __construct(ContainerInterface $c)
    {
        $this->c = $c;
        $this->validator = $this->c->get('validator');
        $this->auth = $this->c->get('auth');
    }
}