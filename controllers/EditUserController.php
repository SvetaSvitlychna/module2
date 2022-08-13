<?php
namespace Controllers;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Models\QueryBuilder;

class EditUserController{
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

        $user = $this->db->getOneByID('users',$_GET['id']);

        $this->auth->id();

        $flash = flash();
        echo $this->templates->render('edit',['user'=>$user,'auth'=>$this->auth,'flash'=>$flash]);

    }
    public function update(){
      
        $curent_user = $this->auth->id();
        $edit_user = $_POST['id'];
        $admin = $this->auth->hasRole('1');
        $user = $this->db->is_author($curent_user, $edit_user);
        if ($_POST['id'] == null){
            flash('You do not have permission', 'error');

            header('LOCATION: /');}
        elseif (!$admin && !$user ) {
//            d(123);
//            exit;
            flash('You do not have permission', 'error');

            header('LOCATION: /');
        }else{

        $this->db->update($_POST, 'users', $_GET['id']);

        flash('date is updated','success');

        header('LOCATION: /');
        }

    }
}
