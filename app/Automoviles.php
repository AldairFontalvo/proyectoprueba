<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automoviles extends Model
{
    //
    protected $table = 'ma_automoviles';
    protected $primaryKey = 'Auto_id';
    public $timestamps = false;
}
