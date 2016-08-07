<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOrder extends Model
{
    //
    protected $table='pai_company_order';

    /**
     * @var array
     */
    protected $guarded=[
        'id','updated'
    ];

    public $timestamps = false;
}
