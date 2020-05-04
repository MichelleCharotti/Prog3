<?php
require_once 'archivo.php';

class id{

public function generarID($path,$arrayMiClase,$filtro1,$filtro2)
{
    $flag=true;
    $id=0;
    $i = 0;

    if($arrayMiClase!=null)
    {
        foreach($arrayMiClase as $value)
        {
            if($value["id"])
            {
                    $id=$value["id"]+1; 
            }
            $i++;
        }
        $j = 0;
        foreach($arrayMiClase as $value)
        {
            if($value[$filtro1] == $_POST[$filtro1] && $value[$filtro2] == $_POST[$filtro2] )
            {
                    $flag=false;
                    echo("Ya se encuentra en la lista");
                    return $flag;
            }
        $j++;
        } 
    }
    else
    {
        $id=1;
    }
    return $id;
}
}
?>