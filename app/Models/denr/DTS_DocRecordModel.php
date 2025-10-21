<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;
use App\Models\denr\DTS_DocLogsModel;

class DTS_DocRecordModel extends Model
{
    protected $table= 'dts_document_record';
    // protected $primaryKey = 'DOC_NO';
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

    public function doc_log()
    {
        return $this->hasOne(DTS_DocLogsModel::class, 'DOC_NO', 'DOC_NO');
    }

    public function doc_logs()
    {
        return $this->hasMany(DTS_DocLogsModel::class, 'DOC_NO', 'DOC_NO');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'CREATED_BY');
    }
}
