<?php

// headers to give api permission
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json ; charset=utf-8');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Max-Age: 600');
header('Access-Control-Allow-Headers:*');

// INCLUDE commande product
require_once __DIR__."/../models/Commande.php";

// create product controller class
class CommandeController{

    // constructor
    public function __construct(){}

    // index function to display all commande
    public function index(){
        $commande = new Commande();
        $result = $commande->displayAll();
        // check if there is record
        if($result){
            echo json_encode($result);
        }else{
            echo json_encode([
                'message'=>'No commande'
            ]);
        }
    }

    // create commande
    public function create(){
        $data = json_decode(file_get_contents("php://input"));
        $id_product = $data->id_product;
        $id_user    = $data->id_user;

        // create commande object
        $commande = new Commande();
        $test = $commande->addCommande($id_product,$id_user);

        // check if commande created
        if($test){
            echo json_encode([
                'message'=>'Commande Created successfuly'
            ]);
        }else{
            echo json_encode([
                'message'=>'Commande Not Created'
            ]);
        }
    }
}