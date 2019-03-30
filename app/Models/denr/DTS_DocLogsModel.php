<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class DTS_DocLogsModel extends Model
{
    protected $table= 'dts_document_logs';
    /*protected $fillable = array(
    	'DOC_FROM',
    	'DOC_TO',
    	'DOC_NO',
        'DOC_DT_LOG',
        'DOC_REMARKS',
        'ACTION_REQ',
        'SEEN',
        'STATUS',
    );*/

    public $timestamps = false;
}
