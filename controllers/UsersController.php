<?php

namespace controllers;

use Exception;
use JasonGrimes\Paginator;
use League\Plates\Engine;
use Models\QueryBuilder;
use Delight\Auth\Auth;


class UsersController{

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

        $itemsPerPage = 5;
        $currentPage = $_GET['page'] ?? 1;
        $totalItems = $this->db->getAll('users');
        $users = $this->db->setPaging('users',$itemsPerPage, $currentPage);

        $urlPattern = '?page=(:num)';

        $paginator = new Paginator(count($totalItems), $itemsPerPage, $currentPage, $urlPattern);

        $flash = flash();

        echo $this->templates->render('users',
                                                    ['users'=>$users,
                                                     'paginator'=>$paginator,
                                                     'auth'=>$this->auth,
                                                     'status'=>$this->db,
                                                    'flash'=>$flash]);
    }


    public function logout(){

        try {
            $this->auth->logOutEverywhereElse();
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        }
        $this->auth->destroySession();

        header('LOCATION: /');

    }
    public function delete(){
        $curent_user = $this->auth->id();
        $edit_user = $_GET['id'];
        $admin = $this->auth->hasRole('1');
        $user = $this->db->is_author($curent_user, $edit_user);
        if ($_POST['id'] == null){
            flash('You do not have permission', 'error');

            header('LOCATION: /');}
        elseif(!$admin && !$user) {

            flash('You do not have permission', 'error');

            header('LOCATION: /');
        }else{
        $this->db->delete('users',$_GET['id']);

        flash('Your account is deleted','success');
            $this->auth->destroySession();

        header('LOCATION: /');}

    }

}
