<?php
require_once(dirname(__FILE__) . "/../composerCarp/vendor/autoload.php");
require_once 'base.php';

use NNV\RestCountries;
 class capital extends basic{


     public function __construct()
    {
        parent::__construct();
        $this->array= array("buenos aires","Madrid","berlin","seoul","Islamabad","Brasilia","Sofía","Ottawa","Asmara");
        $this->value = rand(0,8);
    }
    
   public function capitalMostrar(){
       
    $restCountries = new RestCountries;
    $reg=$restCountries-> byCapitalCity($this->array[$this->value]);

    return $reg;
   }

}





?>