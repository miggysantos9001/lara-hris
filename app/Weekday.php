<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekday extends Model
{
    protected $connection = 'mysql';
    protected $table = 'weekdays';

    protected $guarded = [];
}
