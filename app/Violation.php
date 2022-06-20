<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $connection = 'mysql';
    protected $table = 'violations';

    protected $guarded = [];
}
