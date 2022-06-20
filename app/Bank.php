<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $connection = 'mysql';
    protected $table = 'banks';

    protected $guarded = [];
}
