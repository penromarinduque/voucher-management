<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Employee_Position extends Model
{
    protected $table= 'employee_position';
    protected $fillable = array(
    	'id',
        'position_title',
        'position_desc',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
