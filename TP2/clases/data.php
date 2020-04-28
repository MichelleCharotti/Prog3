<?php

namespace data;

class Data{

    public static function save($user){

        if(isset($user)){
            $data = Data::readAll();
            array_push($data,$user);
            $filePath = './archivos/users.json';
            $archivo= fopen($filePath, 'w');
            $rta = fwrite($archivo, json_encode($data));
            fclose($archivo);

            return $rta;
        }

    return false;
}

    public static function readAll(){
    $filePath = './archivos/users.json'; 
    $archivo= fopen($filePath, 'r');
    $data = fread($archivo, filesize($filePath));
    fclose($archivo);

    if(strlen($data)>1){
        $arrayJSON = json_decode($data);
        return $arrayJSON;
    }
    
    return $emptyArray = array();
}

}
?>