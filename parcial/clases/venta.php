<?php
require_once 'id.php';
require_once 'archivo.php';
require_once 'auth.php';
require_once 'pizza.php';

class venta{

    // public $id;
    public $tipo;
    public $sabor;

    public function __construct()
    {
        // $this->id=$_POST["id_producto"];
        $this->tipo=$_POST["tipo"];
        $this->sabor=$_POST["sabor"];
    }

    public function cargarVenta()
    {
        $flag=false;
        $i = 0;
        $precio=0;
        $array=array();
        $flag1=false;

        if(Token::validarJWT()!=null)
        {  
            $miClase = new archivo();
            $arrayMiClase = archivo::leerArchivo ('./archivos/users.json');

            foreach($arrayMiClase as $value)
            {
                if($value['tipo']=='cliente')
                { 
                    $flag=true;
                    break;
                } 
                
            }
        }else {
            echo " Token invalido";
        }
            
     if($flag==true)
     {
        $arrayMiPizza = archivo::leerArchivo ('./archivos/pizzas.json');

        foreach($arrayMiPizza as $valueP)
        {
                  if($this->tipo==$valueP['tipo'] && $this->sabor== $valueP['sabor'] )
                  {
                      if($valueP['stock']>0)
                      {
                        $valueP['stock']=$valueP['stock']-1;
                        $precio=$valueP['precio'];
                        $array[$i]=$valueP;
                        $flag1=true;
                      }else{
                          echo "No hay stock";
                    //   break;
                      }
                  
                  }  $i++;    
     }
if($flag1=true){
     $miClase->guardarArray("./archivos/pizzas.json",$array);
     $fecha=date('l jS \of F Y h:i:s A');
     $info=array($value['mail'],$this,$fecha);
        $miClase -> guardarArchivo("./archivos/venta.json",$info);
        echo "Se cargo venta\n precio:".$precio;
        echo json_encode($this);
}
    }
} 
public function listarVentas()
{
    $i=0;
    if(Token::validarJWT()!=null)
    {  
        $miClase = new archivo();
        $arrayMiClase = archivo::leerArchivo ('./archivos/users.json');
        $arrayMiVenta = archivo::leerArchivo ('./archivos/venta.json');

        foreach($arrayMiClase as $value)
        {
                    foreach($arrayMiVenta as $valueV)
                    {
                        if($value['tipo']=='encargado')
                { 
                    echo json_encode($valueV);
                    $i++;
                    }
                   else if($value['tipo']=='cliente')
                {
                    echo json_encode($valueV);
                }
                } 
        }
    }else {
        echo " Token invalido";
    }
    echo $i;
}
}
?>