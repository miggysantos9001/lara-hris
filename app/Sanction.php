<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanction extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sanctions';

    protected $guarded = [];
}
