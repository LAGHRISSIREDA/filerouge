<?php

// headers to give api permission
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json ; charset=utf-8');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Max-Age: 600');
header('Access-Control-Allow-Headers:*');

// INCLUDE commande product
require_once __DIR__."/../models/Categorie.php";
