<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Family_Background_Children extends Model
{
    protected $table= 'family_background_children';
    protected $fillable = array(
    	'id',
    	'user_id',
    	'child_name',
        'child_bdate'
    );

    public $timestamps = false;
}
