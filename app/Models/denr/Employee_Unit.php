<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Employee_Unit extends Model
{
    protected $table= 'employee_unit';
    protected $fillable = array(
    	'id',
        'division_id',
        'section_id',
        'unit',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
