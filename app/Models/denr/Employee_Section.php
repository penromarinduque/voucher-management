<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Employee_Section extends Model
{
    protected $table= 'employee_section';
    protected $fillable = array(
    	'id',
        'division_id',
        'section',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
