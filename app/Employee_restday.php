<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_restday extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employee_restdays';

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Employee','employee_id','id');
    }
}
