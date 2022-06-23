<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_schedule extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employee_schedules';

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Employee','employee_id','id');
    }
}
