<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_geninfo extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employee_geninfos';

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Employee','employee_id','id');
    }

    public function department(){
        return $this->belongsTo('App\Department','department_id','id');
    }

    public function branch(){
        return $this->belongsTo('App\Branch','branch_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function status(){
        return $this->belongsTo('App\Employee_status','status_id','id');
    }
}
