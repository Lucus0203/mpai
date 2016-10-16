<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnualCourseLibraryType extends Model
{
    /**
     * @var string
     */
    protected $table='pai_annual_course_library_type';

    /**
     * @var array
     */
    protected $guarded=[
        'id','created'
    ];

    public $timestamps = false;
}
