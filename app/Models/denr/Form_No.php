<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Form_No extends Model
{
    protected $table= 'form_no';
    /*protected $fillable = array(
    	'id',
        'DOC_TYPE',
        'form_text',
        'form_no',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );*/

    public $timestamps = false;
}
