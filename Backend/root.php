<?php

$params = explode('/',$_GET['url']);
// I check if controller exist or no
// echo $params;
// die()
if(isset($params[0]) && !empty($params[0])){
    $controller = ucfirst($params[0]).'Controller';
    // I'll check if this controller exist int controllers folder
    if(file_exists("controllers/".$controller.".php")){
        // include $controller file and instantiate object
        require_once "controllers/".$controller.".php";
        $obj = new $controller();
        // check if we have seconde param in url
        if(isset($params[1]) && !empty($params[1])){
            $action = $params[1];
            // check if method exist in $controller file
            if(method_exists($obj,$action)){
                // check for third params in url
                if(isset($params[2]) && !empty($params[2])){
                    $obj->$action($params[2]);
                }else{
                    $obj->$action();
                }
            }else{
                echo "method not founded";
            }
        }else{
            $action ="index";
            $obj->$action();
        }
        
    }else{
        echo "Controller not founded";
    }
}else{
    echo "Not founded";
}