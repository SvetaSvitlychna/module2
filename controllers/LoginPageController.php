<?php

namespace controllers;
use Delight\Auth\Auth;
use Delight\Cookie\Session;
use Models\QueryBuilder;
use League\Plates\Engine;
use PDO;
use Tamtamchik\SimpleFlash\Flash;


class LoginPageController
{
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

$flash =flash();
echo $this->templates->render('page_login', ['title'=>'login','flash'=>$flash]);
}
public function logIn(){


    try {
        $this->auth->login($_POST['email'], $_POST['password']);

        @Session::start();

        flash('You are logged in','success');

        header('LOCATION: /');

    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        flash('Wrong email address','error');
        header('LOCATION: /login');

    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        flash('Wrong password', 'error');
        header('LOCATION: /login');
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
        flash('Email not verified', 'error');
        header('LOCATION: /login');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        flash('Too many requests', 'error');
        header('LOCATION: /login');
    }


}

}