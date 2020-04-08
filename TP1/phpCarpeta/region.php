<?php
require_once(dirname(__FILE__) . "/../composerCarp/vendor/autoload.php");
require_once 'base.php';

use NNV\RestCountries;
 class region  extends basic{
  
     public function __construct()
    
    {
        parent::__construct();
        $this->array= array("asia","africa","americas","europe","oceania");
        $this->value = rand(0,4);
    }
    
   public function RegionMostrar(){

    $restCountries = new RestCountries;
    $reg=$restCountries-> byRegion ($this->array[$this->value]);

    return $reg;
   }

}





?>