<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbilityModel extends Model
{
    /**
     * @var string
     */
    protected $table='pai_ability_model';

    /**
     * @var array
     */
    protected $guarded=[
        'id','updated'
    ];

    public $timestamps = false;
}
