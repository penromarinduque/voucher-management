<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Employee_Division extends Model
{
    protected $table= 'employee_division';
    protected $fillable = array(
    	'id',
        'division',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
