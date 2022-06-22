<?php

// include connection clas
require_once "connection.php";

// header to give autorisation
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');

// create categorie class
class Categorie{
    private $table = 'categories';

    // construct
    public function __construct(){}

    // get all categorie
    public function displayAll(){
        $ctn = new Connection();
        return $ctn->selectAll($this->table);
    }
}