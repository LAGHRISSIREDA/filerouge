<?php

// include connection clas
require_once "connection.php";

// header to give autorisation
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');

class Commande{
    private $table = 'commander';

    // constructor
     public function __construct(){}

    // public function
    public function displayAll(){
        $ctn = new Connection();
        return $ctn->selectAll($this->table);
    }

    // display one record from data with specfic id
    public function displayOne($id){
        $ctn = new Connection();
        $test = $ctn->selectOne($this->table,$id);
        if($test) return $test;
        else return false;
    }

    // add new commande
    public function addCommande($id_product,$id_user){
        $ctn = new Connection();
        $test = $ctn->insert($this->table,['id_product','id_user'],[$id_product,$id_user]);
        if($test)return true;
        else return false;
    }


}