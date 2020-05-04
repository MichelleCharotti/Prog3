<?php
require_once 'usuario.php';

class archivo{

    public static function guardarArchivo($path,$info){
                    
        if($path != null)
        {
        $actual=json_encode($info);
        
        if(file_exists($path))
        {
            $file = fopen($path, "a");		 
        }else
        {
            $file = fopen($path, "w");	 
        }
        $renglon = $actual.="\r\n";
        
        fwrite($file, $renglon); 		 
        fclose($file);  
    }
      }

    public static function leerArchivo($path){
        $archivo = $path;
		if(file_exists($archivo))
		{
			$gestor = @fopen($archivo, "r");
			$array = array();
			$i = 0;
			while (($bufer = fgets($gestor, 4096)) !== false)
        	{
                $miClase = new usuario();
                $miClase = json_decode($bufer, true);
        		$array[$i] = $miClase;
        		$i++;
           	}
           	
           	if (!feof($gestor)) 
    		{
       	 		echo "Error: fallo inesperado de fgets()\n";
            }		
            	
    		fclose($gestor);
    		return $array;
		}   	
    }      
    public  function guardarArray($path,$array)
    {
        $archivo=fopen($path , "w");  
        foreach ($array as $value) 
        {
            $dato= json_encode($value);
            $dato.="\r\n";
            fwrite($archivo, $dato);
        }
        fclose($archivo);
    }
    
  }

?>