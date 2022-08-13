<?php
namespace Controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use Models\QueryBuilder;

class ProfileController{
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
        $user = $this->db->getOneByID('users',$this->auth->id());
//        $user = $this->auth->id();
        echo $this->templates->render('profile',['user'=>$user,'auth'=>$this->auth,'status'=>$this->db,]);

    }
}
