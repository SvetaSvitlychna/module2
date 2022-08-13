<?php

namespace Controllers;

use League\Plates\Engine;
use Models\QueryBuilder;
use Delight\Auth\Auth;

class CreateUserController{

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


       echo $this->templates->render('create_user',['auth'=>$this->auth,
           'statusList'=>$this->db->statusList()
       ]);

    }
    public function insert(){
        if ($_POST['id'] == null){
            flash('You do not have permission', 'error');

            header('LOCATION: /');}
        elseif(!$this->auth->hasRole('1')){
            flash('You do not have permission', 'error');

            header('LOCATION: /');
        } else{
            try {
                $userId = $this->auth->admin()->createUser($_POST['email'],
                    $_POST['password'], $_POST['username']);
                $this->db->update(
                    ['id'=>$userId ,
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'company' => $_POST['company'],
                        'job' => $_POST['job'],
                        'user_address' => $_POST['user_address'],
                        'status' => $_POST['status'],

                        'fb' => $_POST['fb'],
                        'telegram' => $_POST['telegram'],
                        'phone' => $_POST['phone']
                    ], 'users', $userId);

                $result = pathinfo($_FILES['image']['name']);
                $filename = time() . "_" . $result['filename'] . "." . $result['extension'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $filename);
                $this->db->updateImage($userId, $filename, 'users');
                flash('New user is successfully created', 'success');
                header('LOCATION: /');

            } catch (\Delight\Auth\InvalidEmailException $e) {
                die('Invalid email address');
            } catch (\Delight\Auth\InvalidPasswordException $e) {
                die('Invalid password');
            } catch (\Delight\Auth\UserAlreadyExistsException $e) {
                die('User already exists');
            }}

    }
    public function displayStatus($user){

            if($user['status']==='online'){
                return "<span class=\"status status-success mr-3\">";}
            if($user['status']==='away'){
                return "<span class=\"status status-warning mr-3\">";}
            if($user['status']==='busy'){
                return "<span class=\"status status-danger mr-3\">";}
        }


}
