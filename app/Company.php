<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table='pai_company';

    protected $fillable=['note'];

    public $timestamps = false;
}
