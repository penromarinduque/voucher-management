<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class DTS_DocAttachmentsModel extends Model
{
    protected $table= 'dts_document_attachments';
    /*protected $fillable = array(
    	'ID',
    	'DOC_NO',
        'FILE_ATTACHMENT'
    );*/

    public $timestamps = false;
}
