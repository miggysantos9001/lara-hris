<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $connection = 'mysql';
    protected $table = 'requirements';

    protected $guarded = [];
}
