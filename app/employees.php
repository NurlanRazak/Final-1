<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    public $table='employees';
    public $primaryKey='emp_no';
    public $timestamps =false;
    
    public function departments(){
     return $this->belongsToMany('App\departments');	
    }

}
