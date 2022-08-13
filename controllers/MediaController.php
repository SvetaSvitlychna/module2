<?php
namespace Controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use Models\QueryBuilder;

class MediaController{
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
        $flash = flash();
        $user = $this->db->getOneByID('users',$_GET['id']);

        echo $this->templates->render('medias',['user'=>$user,
            'auth'=>$this->auth,'status'=>$this->db,'flash'=>$flash]);

    }
    public function update(){

        $curent_user = $this->auth->id();
        $edit_user = $_POST['id'];
        $admin = $this->auth->hasRole('1');
        $user = $this->db->is_author($curent_user, $edit_user);
        if ($_POST['id'] == null){
            flash('You do not have permission', 'error');

            header('LOCATION: /');}
        elseif (!$admin && !$user) {

            flash('You do not have permission', 'error');

            header('LOCATION: /medias');
        }else {
            $result = pathinfo($_FILES['image']['name']);
            $filename = time() . "_" . $result['filename'] . "." . $result['extension'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $filename);

            $this->db->updateImage($_POST['id'], $filename, 'users');

            flash('Your avatar is updated', 'success');

            header('LOCATION: /');
        }

    }
}
