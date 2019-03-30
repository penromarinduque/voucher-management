<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Other_Information extends Model
{
    protected $table= 'other_information';
    protected $fillable = array(
    	'id',
    	'user_id',
        'special_skills_hobbies',
        'non_academic_distinction',
        'membership',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
