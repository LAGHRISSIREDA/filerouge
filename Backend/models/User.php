<?php
// include connection class
 require_once "connection.php";

// header to give permission
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');

//  declaration of user class
class User{
    private $table = 'users';

    // constructor
    public function __construct(){}

    // display all users
    public function displayAll(){
        $ctn = new Connection();
        return $ctn->selectAll($this->table);
    }

    // display one ecord from data with specific ID
    public function displayOne($id){
        $ctn = new connection();
        $test = $ctn->selectOne($this->table,$id);
        if($test) return $test;
        else return false;
    }

    // public function to connect
    public function connect($email,$password){
        $ctn = new Connection();
        return $ctn->connect($this->table,$email,$password);
    }

    // function to add new user
    public function addUser($firstName,$lastName,$email,$password,$phone,$role){
        $ctn = new Connection();
        $test = $ctn->insert($this->table,['firstname','lastname','email','password','role','phone'],[$firstName,$lastName,$email,$password,$role,$phone]);
        if($test) return true;
        else return false;
    }

    // function to update user
    public function update($id,$firstName,$lastName,$password,$phone){
        $ctn = new Connection();
        $test = $ctn->update($this->table,['firstname','lastname','password','phone'],[$firstName,$lastName,$password,$phone],$id);
        if($test)return true;
        else return false;
    }

    // function to delete user
    public function delete($id){
        $ctn = new Connection();
        $test = $ctn->delete($this->table,$id);
        if($test){
            return true;
        }else{
            return false;
        }
    }






}
