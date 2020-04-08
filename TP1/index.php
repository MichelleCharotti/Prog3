<?php   

require_once './phpCarpeta/region.php';
require_once './phpCarpeta/lenguage.php';
require_once './phpCarpeta/capital.php';



$region= new region();
$lenguage = new lenguage();
$capital =new capital();


$request=$_SERVER['REQUEST_METHOD'];
$info=$_SERVER['PATH_INFO'];

switch($info){

    case '/capital':
        if($request=='GET'){
            echo json_encode($capital->capitalMostrar());
        }else{;
            echo "no existe por ese metodo";
        }
        break;
    case '/lenguage':
        if($request=='GET'){
        echo json_encode($lenguage->languageMostrar());
    }else{
         echo "no existe por ese metodo";
    }
        break;  
    case '/region':
        if($request=='GET'){
        echo json_encode($region->RegionMostrar());
    }else{
        echo "no existe por ese metodo";
    }
        break; 
    default: 
    echo "ERROR";
        break;
        
}
?>
