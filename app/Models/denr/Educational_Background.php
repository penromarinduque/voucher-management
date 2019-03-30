<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Educational_Background extends Model
{
    protected $table= 'educational_background';
    protected $fillable = array(
    	'id',
    	'user_id',
    	'level',
        'school_name',
        'basic_education_degree_course',
        'poa_from',
        'poa_to',
        'highest_level_units_earned',
        'year_graduated',
        'scholarship_academic_honors_received',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
