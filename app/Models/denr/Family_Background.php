<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Family_Background extends Model
{
    protected $table= 'family_background';
    protected $fillable = array(
    	'id',
    	'user_id',
    	'spouse_lname',
        'spouse_fname',
        'spouse_mname',
        'spouse_xname',
        'spouse_occupation',
        'spouse_business_name',
        'spouse_business_address',
        'spouse_phone_no',
        'father_lname',
        'father_fname',
        'father_mname',
        'father_xname',
        'mother_maiden_name',
        'mother_lname',
        'mother_fname',
        'mother_mname',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
