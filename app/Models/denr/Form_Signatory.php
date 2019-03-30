<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Form_Signatory extends Model
{
    protected $table= 'form_signatory';
    protected $fillable = array(
    	'id',
        'form_id',
        'recommended_by',
        'approved_by',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
