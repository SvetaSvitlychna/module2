<?php

namespace Controllers;

use Exception;
//use JasonGrimes\Paginator;
use League\Plates\Engine;
use Models\QueryBuilder;
use Aura\SqlQuery\QueryFactory;
use PDO;
use Faker\Factory;


class homepageController
{
    private $templates;
    private $pdo;
    private $db;
    private $queryFactory;
private $title;
    public function __construct()
    {
//        $this->templates = new Engine('../views/templates');
//        $this->pdo = new  PDO("mysql:host=localhost;dbname=module", "root", "root");
//        $this->db = new QueryBuilder();
//        $this->queryFactory =  new QueryFactory('mysql');
//        $this->title = 'Homepage';
    }

    public function homepage()
    {

//        $faker = Factory::create();
//
//       $insert = $this->queryFactory->newInsert();
//               $insert->into('posts');
//        for($i=0;$i<=1;$i++){
//
//            $insert->cols([
//                'title'=>$faker->words(3,true)
//
//            ]);
//            $insert->addRow();
//        }
//        $sth = $this->pdo->prepare($insert->getStatement());
//        $sth->execute($insert->getBindValues());



        $totalItems = $this->db->paginationGetAll('posts');
        $posts = $this->db->paginationSetPaging('posts',3);
        $itemsPerPage = 3;
        $currentPage = $_GET['page'] ?? 1;
        $urlPattern = '?page=(:num)';

      $paginator = new Paginator(count($totalItems), $itemsPerPage, $currentPage, $urlPattern);
        echo $this->templates->render('homepage', ['posts'=>$posts, 'paginator'=>$paginator
            ]);
//        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
//$posts = $db->insert(['title'=>'lalalalalalal'], 'posts');
//$posts = $db->getOneByID('posts',2);
//$posts = $db->update(['title'=>'lalalalalalal1578'], 'posts', 15);
//$posts = $db->delete('posts', 15);

//var_dump($posts);die;

//echo 123;


//var_dump($templates);die;
//        echo $this->templates->render('profile', ['name' => 'Sveta']);
//        if (true) {
//            flash()->message('HOT!', 'error');
//        }
//        echo $this->templates->render('index', ['name'=>'johnathan about page']);
//    }

//public
//public function withdraw($amount = 1){
//    $total =10;
//    throw new \Exception('Your account is blocked');
    }
//public function homepage ($vars){
////d($vars);die;
//    try {
//        $this->withdraw($vars['amount']);
//    }catch (Exception $exception){
//        flash()->error($exception->getMessage());
//// echo $exception->getMessage();
//    }
//
//    echo $this->templates->render('homepage', ['name'=>'johnathan about page']);
//
//}
// public function withdraw($amount = 1){
//        $total =10;
//        if ($amount > $total){
////    throw new AccountBlockedException('Your account is blocked');
//            throw new Exception('Your account is blocked');}
//    }
//}


}