<?php

// headers to give api permission
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json ; charset=utf-8');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Max-Age: 600');
header('Access-Control-Allow-Headers:*');

// INCLUDE commande product
require_once __DIR__."/../models/Categorie.php";

// create categoriecontroller class

class CategorieController{

    // create constructor
    public function __construct(){}

    // create index function to get all categorie from data
    public function index(){
        // create object from categorie class
        $cat = new Categorie();
        $result = $cat->displayAll();

        // check if any result
        if($result){
            echo json_encode($result);
        }else{
            echo json_encode([
                'message'=>' there is no record '
            ]);
        }
    }
}