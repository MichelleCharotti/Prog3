<?php
namespace App\Models;

class Usuario extends \Illuminate\Database\Eloquent\Model
{
    // Esto es usado por el controller para comunicarse con la ddbb
    public $timestamps = false;
    protected $table = 'usuarios';
}

?>