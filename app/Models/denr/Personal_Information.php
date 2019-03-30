<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Personal_Information extends Model
{
    protected $table= 'personal_information';
    protected $fillable = array(
    	'id',
    	'user_id',
    	'birth_date',
    	'birth_place',
    	'sex',
    	'civil_status',
    	'height',
    	'weight',
    	'blood_type',
    	'gsis_no',
    	'pagibig_no',
    	'philhealth_no',
    	'sss_no',
    	'tin_no',
    	'agency_emp_no',
    	'citizenship_filipino',
    	'citizenship_dual',
    	'by_birth',
    	'by_naturalization',
    	'indicated_country',
    	'res_house_block_lot',
    	'res_street',
    	'res_subdivision',
    	'res_barangay',
    	'res_municipality',
    	'res_province',
    	'res_zip_code',
    	'per_house_block_lot',
    	'per_street',
    	'per_subdivision',
    	'per_barangay',
    	'per_municipality',
    	'per_province',
    	'per_zip_code',
    	'tel_no',
    	'mobile_no',
    	'email_address',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
