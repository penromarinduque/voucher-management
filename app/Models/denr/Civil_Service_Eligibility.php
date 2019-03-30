<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Civil_Service_Eligibility extends Model
{
    protected $table= 'civil_service_eligibility';
    protected $fillable = array(
    	'id',
    	'user_id',
    	'career_service',
        'rating',
        'examination_date',
        'examination_place',
        'license_number',
        'license_date_validity',
        'created_by',
    	'created_at',
        'updated_by',
    	'updated_at'
    );

    public $timestamps = false;
}
