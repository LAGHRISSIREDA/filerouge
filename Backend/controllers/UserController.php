<?php

// header to give autorisation
 header('Access-Control-Allow-Origin:*');
 header('Content-Type: application/json ; charset=utf-8');
 header("Access-Control-Allow-Methods:*"); 
 header("Access-Control-Max-Age: 600");
 header("Access-Control-Allow-Headers:*");

// include model
require_once __DIR__."/../models/User.php";

class UserController{

    // constructor 
    public function __construc(){
        
    }

    // index function
    public function index(){
        $user = new User();
        $result = $user->displayAll();
        // check if there is no result
        if($result){
            echo json_encode($result);
        }else{
            echo json_encode([
                'message'=>'User Not founded'
            ]);
        }
    }

    // create  user
    public function create(){
        $data = json_decode(file_get_contents("php://input"));
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $email = $data->email;
        $password = $data->password;
        
        $phone = $data->phone;
        $role = $data->role;

        // create user object
        $user = new User();
        $test = $user->addUser($firstname,$lastname,$email,$password,$phone,$role);
        if($test){
            echo json_encode([
                'message'=>'User created successfuly'
            ]);
        }else{
            echo json_encode([
                'message'=>'User Not created'
            ]);
        }

    }

    // update user infos
    public function update(){
        $data = json_decode(file_get_contents("php://input"));

        $id = $data->id;
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $password = $data->password;
        $phone = $data->phone;
        // create user object
        $user = new User();
        $test = $user->update($id,$firstname,$lastname,$password,$phone);
        if($test){
            echo json_encode([
                'message'=>'User Updated successfuly'
            ]);
        }else{
            echo json_encode([
                'message'=>'Uset Not Updated'
            ]);
        }
    }

    // read single one record
    public function read_single(){
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        // create new object from user class
        $user = new User();
        $test = $user->displayOne($id);
        if($test){
            echo json_encode($test);
        }else{
            echo json_encode([
                'message'=>'User Not founded'
            ]);
        }
    }


    // delete function
    public function delete(){
        // create user object
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        $user = new User();
        $test = $user->delete($id);
        if(!$test){
            echo json_encode([
                'message'=>'User Deleted Successfuly'
            ]);
        }else{
            echo json_encode([
                'message'=>'User Not Deleted'
            ]);
        }

    }

    // function connect
    public function connect(){
        $data = json_decode(file_get_contents("php://input"));
        $email = $data->email;
        $password = $data->password;
        // create user object
        $user = new User();
        $test = $user->connect($email,$password);
        if($test){
            echo json_encode($test);
        }else{
            echo json_encode([
                'message'=>'User Not Found'
            ]);
        }

    }
}

