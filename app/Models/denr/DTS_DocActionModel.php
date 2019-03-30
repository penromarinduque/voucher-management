<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class DTS_DocActionModel extends Model
{
    protected $table= 'dts_action_to_be_taken';
    /*protected $fillable = array(
    	'ID',
    	'DOC_NO',
        'FILE_ATTACHMENT'
    );*/

    public $timestamps = false;
}
