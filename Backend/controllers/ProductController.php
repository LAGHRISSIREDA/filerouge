<?php

// headers to give api permission
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json ; charset=utf-8');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Max-Age: 600');
header('Access-Control-Allow-Headers:*');

// include product model
require_once __DIR__."/../models/Product.php";

// create productcontroller class
class ProductController{

    // constructor
    public function __construct(){}

    // index function
    public function index(){
        $product = new Product();
        $result = $product->displayAll();
        // check if there is no result
        if($result){
            echo json_encode($result);
        }else{
            echo json_encode([
                'message'=>'Product Not founded'
            ]);
        }
    }

    // create product

    public function create(){
        $product = new Product();
        $name         = $_POST['name'];
        $description  = $_POST['description'];
        $active       = $_POST['active'];
        $price        = $_POST['price'];
        $id_categorie = $_POST['id_categorie'];
        $date_end     = $_POST['date_end'];
        $id_user     = $_POST['id_user'];
        $fileName     = $_FILES['picture']['name'];
        $tempPath     = $_FILES['picture']['tmp_name'];
        $fileSize     = $_FILES['picture']['size'];
        // var_dump($price);
        // die();
        if(empty($fileName))
    {
        $errorMSG = json_encode(array('error' => 'Please select an image', 'status' => false));
        echo $errorMSG;
    }else
    {
        $upload_path = 'C:\xampp\htdocs\FrontEnd\filerouge\public\uploads/';
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileName = uniqid().'.'.$fileExt;
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

        if(in_array($fileExt, $valid_extensions))
        {
            if(!file_exists($upload_path . $fileName)){
                if($fileSize < 5000000)
                {
                    move_uploaded_file($tempPath, $upload_path . $fileName);
                }else
                {
                    $errorMSG = json_encode(array('error' => 'Your file is too large', 'status' => false));
                    echo $errorMSG;
                }
            }else
            {
                $errorMSG = json_encode(array('error' => 'File already exists', 'status' => false));
                echo $errorMSG;
            }
        }else {
            $errorMSG = json_encode(['error' => 'Invalid file type', 'status' => false]);
            echo $errorMSG;
        }
    
    }

    if(!isset($errorMSG))
    {        
            $json= json_encode($product->addProduct($name,$description,$price,$date_end,$id_user,$active,$id_categorie,$fileName));
            $successMSG = json_encode(true);
            echo $successMSG;

    }else{
        echo json_encode(false);
    }
        // ----------------------------------------------------------------New Method---------------------------
        // $data = json_decode(file_get_contents("php://input"));
        // $name        = $data->name;
        // $description = $data->description;
        // $price       = $data->price;
        // $date_end    = $data->date_end;
        // $id_user     = $data->id_user;
        // $active      = $data->active;
        // $id_categorie= $data->id_categorie;
        // $picture     = $data->picture;

        // // create product object
        // $product = new Product();
        // $test = $product->addProduct($name,$description,$price,$date_end,$id_user,$active,$id_categorie,$picture);
        // if($test){
        //     echo json_encode([
        //         'message'=>'Product Created Successfuly'
        //     ]);
        // }else{
        //     echo json_encode([
        //         'message'=>'Product Not created '
        //     ]);
        // }
    }


    // update function
    public function update(){
        $data = json_decode(file_get_contents("php://input"));

        $id          = $data->id;
        $name        = $data->name;
        $description = $data->description;
        $price       = $data->price;
        $date_end    = $data->date_end;
        $active      = $data->active;

        // create product object 
        $product = new Product();
        $test = $product->update($id,$name,$description,$price,$date_end,$active);
        if($test){
            echo json_encode([
                'message'=>'Product Updated Successfuly'
            ]); 
        }else{
            echo json_encode([
                'message'=>'Product Not Updated'
            ]);
        }

    }

    // update price production
    public function updateproduct(){
        $data = json_decode(file_get_contents("php://input"));
        $id     = $data->id;
        $price  = $data->price;

        // create object product
        $product = new Product();
        $test = $product->updatePrice($id,$price);
        if($test){
            echo json_encode([
                'message'=>'Price Updated'
            ]);
        }else{
            echo json_encode([
                'message'=>'Product Not Updated'
            ]);
        }
    }



    // read single product record
    public function read_single(){
            $data = json_decode(file_get_contents("php://input"));
            $id = $data->id;
            // create new object from product claaa
            $product = new Product();
            $test = $product->displayOne($id);
            if($test){
                echo json_encode($test);
            }else{
                echo json_encode([
                    'message'=>'Product Not founded'
                ]);
            }
    }

    // delete function
    public function delete(){
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        // create object from product class
        $product = new Product();
        $test = $product->delete($id);
        if(!$test){
            echo json_encode([
                'message'=>'Product Deleted Successfuly'
            ]);
        }else{
            echo json_encode([
                'message'=>'Product Not Deleted'
            ]);
        }
    }


    // gett all product commander

    public function getproducts(){
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        // create object from product class
        $product = new product();
        $test = $product->getProduct($id);
        if($test){
            echo json_encode($test);
        }else{
            echo json_encode([
                'message'=>'There is no commande'
            ]);
        }

    }

    // return all product of one user
    public function getproductuser(){
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        // create object from product
        $product = new Product();
        $test = $product->getProductUser($id);
        if($test){
            echo json_encode($test);
        }else{
           echo json_encode([
                'message'=>'There is no Product'
            ]);
        }
    }


   
}
