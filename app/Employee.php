<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employees';

    protected $guarded = [];

    public function getFullNameAttribute(){
        return $this->lastname.', '.$this->firstname.' '.$this->middlename.' '.$this->extname;
    }

    public function emp_geninfo(){
        return $this->hasOne('App\Employee_geninfo','employee_id','id');
    }

    public function emp_salinfo(){
        return $this->hasOne('App\Employee_salaryinfo','employee_id','id');
    }

    public function emp_schedule(){
        return $this->hasOne('App\Employee_schedule','employee_id','id');
    }

    public function emp_restday(){
        return $this->hasMany('App\Employee_restday','employee_id','id');
    }
}
