<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_salaryinfo extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employee_salaryinfos';

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Employee','employee_id','id');
    }

    public function bank(){
        return $this->belongsTo('App\Bank','bank_id','id');
    }
}
