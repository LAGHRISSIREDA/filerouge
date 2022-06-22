<?php

class Connection{
    
    private $localhost = "localhost";
    private $username  = "root";
    private $password  = "";
    private $database  = "filerouge";
    private $conn ;


    // constructor
    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=$this->localhost;dbname=$this->database",$this->username,$this->password);
        }catch(PDOException $e){
            echo "Connection Failed $e->getMessage()";
        }
    }

    // standard function to add value into table
    public function insert($table,$tableCln,$tableVal){
        $names  = "";
        $values = "";
        $vrls   = "";

        for($i=0;$i<count($tableCln);$i++){
            if($i>0){
                $vrls = ",";
            }
            $names .= $vrls."`".$tableCln[$i]."`";
            $values.= $vrls."'".$tableVal[$i]."'";
        }
       $str = "INSERT INTO `$table`(".$names.") VALUES(".$values.")";
       $query = $this->conn->prepare($str);
       return $query->execute();
    }

    // standard update function to modify value tuggles into table
    public function update($table,$tableCln,$tableVal,$id){
        $names="";
        $vrls="";
        for($i=0;$i<count($tableCln);$i++){
            if($i>0){
                $vrls=",";
            }
            $names.=$vrls."`".$tableCln[$i]."`='".$tableVal[$i]."'";
        }
        $query = "update $table set $names where id=?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    // standard function to select all value of table
    public function selectAll($table){
        $stmt = $this->conn->prepare("Select * from `$table`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // standard function to select on of record in table
    public function connect($table,$email,$password){
        $stmt = $this->conn->prepare("select * from `$table` WHERE email=? AND password=?");
        $stmt->execute([$email,$password]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // standard select function by id
    public function selectOne($table,$id){
        $stmt = $this->conn->prepare("select * from `$table` WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // standard select function by id
    public function selectAllProductUser($table,$id){
        $stmt = $this->conn->prepare("select * from `$table` WHERE id_user=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // standard function to delete one item from table
    public function delete($table,$id){
        $stmt = $this->conn->prepare("delete from `$table` where id=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // costume request to Search data
    public function getProduct($table,$table1,$id){
        $stmt = $this->conn->prepare("SELECT DISTINCT $table.id,$table.name,$table.description,$table.date_end,$table.active 
                                        FROM $table
                                        LEFT JOIN $table1 ON $table.id = $table1.id_product
                                        WHERE $table1.id_user = ?
                                    ");

        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}