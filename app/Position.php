<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $connection = 'mysql';
    protected $table = 'positions';

    protected $guarded = [];
}
