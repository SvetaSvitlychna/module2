<?php

namespace Controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use Models\QueryBuilder;

class PageNotFoundController{
    private $templates;
    private $auth;
    private $db;
    public function __construct(Engine $engine, QueryBuilder $db, Auth $auth)
    {
        $this ->db = $db;
        $this->templates = $engine;
        $this->auth = $auth;

    }
    public function index(){


        echo $this->templates->render('404');

    }
}