<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Voluntary_Work extends Model
{
    protected $table= 'voluntary_work';
    protected $fillable = array(
    	'id',
    	'user_id',
        'name_address_org',
        'inclusive_date_from',
        'inclusive_date_to',
        'number_of_hours',
        'position_nature_work',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
