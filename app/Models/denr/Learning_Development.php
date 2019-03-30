<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Learning_Development extends Model
{
    protected $table= 'learning_development';
    protected $fillable = array(
    	'id',
    	'user_id',
        'learning_title',
        'inclusive_date_from',
        'inclusive_date_to',
        'number_of_hours',
        'type_id',
        'conducted_by',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    );

    public $timestamps = false;
}
