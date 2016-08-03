<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbilityJob extends Model
{
    /**
     * @var string
     */
    protected $table='pai_ability_job';

    /**
     * @var array
     */
    protected $guarded=[
        'id','created','updated'
    ];

    public $timestamps = false;
}
