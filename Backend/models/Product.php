<?php

// include connection clas
require_once "connection.php";

// header to give autorisation
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');

// declaration of product class
class Product{
    private $table = 'products';
    private $table1 = 'commander';

    // constructor
    public function __construct(){}

    // display all products
    public function displayAll(){
        $ctn = new Connection();
        return $ctn->selectAll($this->table);
    }

    // display one record from data with specific id
    public function displayOne($id){
        $ctn = new Connection();
        $test = $ctn->selectOne($this->table,$id);
        if($test)return $test;
        else return false;
    }

    // return all product buy by user id
    public function getProductUser($id){
        $ctn = new Connection();
        $test = $ctn->selectAllProductUser($this->table,$id);
        if($test)return $test;
        else return false;
    }

    // function to add new product
    public function addProduct($name,$description,$price,$date_end,$id_user,$active,$id_categorie,$picture){
        $ctn = new Connection();
        $test = $ctn->insert($this->table,['name','description','price','date_end','id_user','active','id_categorie','picture'],[$name,$description,$price,$date_end,$id_user,$active,$id_categorie,$picture]);
        if($test)return true;
        else return false;
    }

    // function to update 
    public function update($id,$name,$description,$price,$date_end,$active){
        $ctn = new Connection();
        $test = $ctn->update($this->table,['name','description','price','date_end','active'],[$name,$description,$price,$date_end,$active],$id);
        if($test) return true;
        else return false;
    }

    // function to price of product update 
    public function updatePrice($id,$price){
        $ctn = new Connection();
        $test = $ctn->update($this->table,['price'],[$price],$id);
        if($test) return true;
        else return false;
    }

    // function to delete product
    public function delete($id){
        $ctn = new Connection();
        $test = $ctn->delete($this->table,$id);
        if($test) return true;
        else return false;
    }

    // function to get product buy 
    public function getProduct($id){
        $ctn = new Connection();
        $test = $ctn->getProduct($this->table,$this->table1,$id);
        if($test) return $test;
        else return false;
    }

    // function to update statut
    // public function updateStatut($id){
    //     $ctn = new Connection();
    //     $test = $ctn->update($this->table,['active'],0,$id);
    //     if($test) return true;
    //     else return false;
    // }


}