<?php
require_once 'archivo.php';
require_once 'auth.php';

class usuario{

    public $email;
    public $clave;
    public $tipo;

    public function __construct()
    {
        $this->email=$_POST["email"];
        $this->clave=$_POST["clave"];
        $this->tipo=$_POST["tipo"]; 
    }

    public function cargarUsuario()
    {
            $miClase = new archivo();
        $arrayMiClase = archivo::leerArchivo ('./archivos/users.json');
    //  $retorno=id::generarID('./archivos/datos.json',$arrayMiClase,'dni');
    
    //  if($retorno >0 && $retorno !=false)
    //  {
        // $this->id=$retorno;
        $miClase -> guardarArchivo('./archivos/users.json',$this);
       echo "Cargado";
    //  }
    }

    public function loginUsuario()
{
if(isset($_POST["email"]) && isset($_POST['clave']) )
{
    $mail=strtolower($_POST["mail"]);
    $clave=strtolower($_POST["clave"]);
    $arrayMiClase = archivo::leerArchivo('./archivos/users.json');
   	$flag=false;
    $i = 0;
    
    if($arrayMiClase!=null)
    {
    foreach($arrayMiClase as $value)
    {
        if($value["mail"] == $mail && $value["clave"]==$clave)
        {
            $flag= true;
            echo "Existe "; 
        echo json_encode(Token::generarJWT($value));
        break;
        }
        $i++;
    }
    if($flag==false)
    {
    	echo "No existe";
    }
    }
    else
    {
        echo "Error al leer archivo";
    }
}
else
{
    echo "Error en los datos";
}
    
}

}
?>