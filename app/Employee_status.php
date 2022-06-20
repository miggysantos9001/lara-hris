<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_status extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employee_statuses';

    protected $guarded = [];
}
