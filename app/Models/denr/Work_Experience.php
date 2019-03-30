<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Work_Experience extends Model
{
    protected $table= 'work_experience';
    protected $fillable = array(
    	'id',
    	'user_id',
        'inclusive_date_from',
        'inclusive_date_to',
        'position_title',
        'department_agency_office_company',
        'monthly_salary',
        'salary_job_pay_grade',
        'appointment_status',
        'government_service',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
