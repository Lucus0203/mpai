<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnualCourseLibrary extends Model
{
    /**
     * @var string
     */
    protected $table='pai_annual_course_library';

    /**
     * @var array
     */
    protected $guarded=[
        'id','created'
    ];

    public $timestamps = false;
}
