<?php
require_once(dirname(__FILE__) . "/../composerCarp/vendor/autoload.php");
require_once 'base.php';

use NNV\RestCountries;
 class lenguage  extends basic{


     public function __construct($array="idioma",$value=0)
    
    {
        parent::__construct();
        $this->array=array("fr","bs","ja","kk","ko","la","it","qu","es","en");
        $this->value=rand(0,9);
    }
    
   public function languageMostrar(){
       
    $restCountries = new RestCountries;
    $reg=$restCountries->byLanguage($this->array[$this->value]);

    return $reg;
   }

}





?>