<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departments extends Model
{
    public $table='departments';
    public $primaryKey='dept_no';
    public $timestamps =false;
      public function employees(){
     return $this->belongsToMany('App\employees');	
    }
}
