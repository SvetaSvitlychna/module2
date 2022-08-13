<?php
namespace Controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use Models\QueryBuilder;

class StatusController{

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
        $this->auth->id();

        echo $this->templates->render('status',['auth'=>$this->auth,
                                                      'list'=>$this->db->statusList(),
                                                     'flash'=>$flash,
                                             'user'=>$user,
        ]);

    }
//    public function statusList(){
//        $statusList = [
//            "0"=>"away",
//            "1"=>"online",
//            "2"=>"busy",
//        ];
//        return $statusList;
//    }
    public function update()
    {
        $curent_user = $this->auth->id();
        $edit_user = $_POST['id'];
        $admin = $this->auth->hasRole('1');
        $user = $this->db->is_author($curent_user, $edit_user);
        if ($_POST['id'] == null){
            flash('You do not have permission', 'error');

            header('LOCATION: /');}
        elseif (!$admin && !$user) {
//            d(123);
//            exit;
            flash('You do not have permission', 'error');

            header('LOCATION: /status');
        }
else{
//        if(!($this->auth->getRoles() == 'ADMIN') || !$this->db->is_author($curent_user,$edit_user)){
////            d(123);exit;
//            flash('You do not have permission','danger');
//
//            header('LOCATION: /status');
//
//        }

            $this->db->update($_POST, 'users', $_POST['id']);

            flash('Your status is updated', 'success');

            header('LOCATION: /');

    }}

}
