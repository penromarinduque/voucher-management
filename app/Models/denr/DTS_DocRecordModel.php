<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class DTS_DocRecordModel extends Model
{
    protected $table= 'dts_document_record';
    /*protected $fillable = array(
    	'DOC_NO',
        'DOC_TYPE',
    	'DOC_DATE',
        'DOC_TIME',
        'ORIGIN_OFFICE',
        'DOC_ADDRESS',
        'DOC_SUBJ',
        'DOC_CLASSIFICATION',
        'DOC_URGENT',
        'REMARKS',
        'STATUS',
        'SIGNED',
        'CREATED_BY'
    );*/

    public $timestamps = false;
}
