<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Audit_Trail_Log extends Model
{
    protected $table= 'audit_trail_log';
    protected $fillable = array(
    	'id',
    	'user_id',
    	'date_action',
        'action_type',
        'window_page',
        'window_type',
        'module_code',
        'remarks'
    );

    public $timestamps = false;
}
