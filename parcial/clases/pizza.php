<?php
require_once './composerTest/vendor/autoload.php';
require_once 'id.php';
require_once 'archivo.php';
require_once 'auth.php';
// require_once 'usuario.php';

class pizza{

    public $id;
    public $tipo;
    public $precio;
    public $stock;
    public $sabor;
    public $foto;

    public function __construct()
    {
        $this->id=$id;
        $this->tipo=$_POST["tipo"];
        $this->precio=$_POST ["precio"];
        $this->stock=$_POST["stock"];
        $this->sabor=$_POST["sabor"];
        $this->foto=$this->imag($this->tipo);
    }

public function imag($tipo)
{
    $foto=$_FILES['foto'];

    $exten=array_reverse(explode(".",$foto["name"])); 
    $this->foto=$tipo."_"."foto.".$exten[0];  
    $info=move_uploaded_file($foto["tmp_name"],"./imagenes/".$this->foto);

    // $watermark = new Watermark($info);
    // $watermark->setFontSize(48)
    //    ->setRotate(30)
    //    ->setOpacity(.4);
    
    // // $watermark->withText('ajaxray.com', $info);
    // $watermark->withImage('./imagenes/marcaAgua.png', $info);

}

public function cargarPizza()
    {
        $flag=false;
       
        if(Token::validarJWT()!=null)
        {  
            $miClase = new archivo();
            $arrayMiClase = archivo::leerArchivo ('./archivos/users.json');

            foreach($arrayMiClase as $value)
            {
                if($value['tipo']=='encargado')
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
        $arrayMiProduc = archivo::leerArchivo ('./archivos/pizzas.json');
        $retorno=id::generarID('./archivos/pizzas.json',$arrayMiProduc,'tipo','sabor');
         if($retorno >0 && $retorno !=false)
         {
            $this->id=$retorno;
           $miClase -> guardarArchivo('./archivos/pizzas.json',$this);
          echo "Cargado";
        }
     }else{
         echo "Error. Tiene que ser encargado";
     }
    
    }
    public function listarPizza()
    {
        if(Token::validarJWT()!=null)
        {  
            $miClase = new archivo();
            $arrayMiClase = archivo::leerArchivo ('./archivos/users.json');
            $arrayMiPizza = archivo::leerArchivo ('./archivos/pizzas.json');
    
            foreach($arrayMiClase as $value)
            {
                if($value['tipo']=='encargado')
                    { 
                        foreach($arrayMiPizza as $valueP)
                        { echo "encargado";
                        echo json_encode($valueP);}
                    }    
                else // if($value['tipo']=='cliente')
                    {
                        foreach($arrayMiPizza as $valueP)
                        { echo "cliente";
                        echo json_encode($valueP['tipo']);
                        echo json_encode($valueP['precio']);
                        echo json_encode($valueP['sabor']);
                    }
                    } 
            }
        }else {
            echo " Token invalido";
        }
    }
}
?>