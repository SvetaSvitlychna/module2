<?php

namespace Models;

use Aura\SqlQuery\QueryFactory;
use PDO;

class QueryBuilder{

    private $pdo;
    private $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory){

        $this->pdo = $pdo;
        $this->queryFactory =  $queryFactory;
    }

    public function getAll($table){

        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from ($table);

             $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOneByID($table, $id){

        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from ($table)
            ->where("id =:id")
            ->bindValues(['id'=>$id]);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getOneByEmail($table, $email){

        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from ($table)
            ->where("email =:email");
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert ($data,$table){
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)
            ->cols($data);
        $sth = $this->pdo->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
        return $this->pdo->lastInsertId();
    }
    public function update ($data, $table, $id){

        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)
            ->cols($data)
            ->where("id = :id");
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());

    }

    public function delete ($table, $id){
        $delete = $this->queryFactory->newDelete();
        $delete
            ->from($table)
            ->where("id = $id");
        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }

    public function setPaging($table,$setPaging,$currentPage){
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->setPaging($setPaging)
            ->page($currentPage)
            ->groupBy(['id DESC']) ;
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    function updateImage($id,$filename, $table){

        $update = $this->queryFactory->newUpdate();

        $update
            ->table($table)
            ->cols(['image', 'id'])
            ->where("id = :id")
            ->bindValues(['id'=>$id,'image' =>$filename]);
        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());
    }
    public function displayStatus($user){

        if($user['status']==='1'){
            return "<span class=\"status status-success mr-3\">";}
        if($user['status']==='0'){
            return "<span class=\"status status-warning mr-3\">";}
        if($user['status']==='2'){
            return "<span class=\"status status-danger mr-3\">";}
    }


    public function statusList(){
        $statusList = [
            "0"=>"away",
            "1"=>"online",
            "2"=>"busy",
        ];
        return $statusList;
    }

    public function is_author($loggedIn_user, $edit_user){
        if($loggedIn_user ==$edit_user){
            return true;
        }
        return false;
}


}