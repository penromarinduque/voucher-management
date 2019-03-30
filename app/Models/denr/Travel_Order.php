<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Travel_Order extends Model
{
    protected $table= 'travel_order';
    protected $fillable = array(
    	'id',
        'order_no',
        'user_id',
        'position_id',
        'recom_status',
        'approval_status',
        'date_filling',
        'station',
        'salary',
        'division',
        'section',
        'unit',
        'departure_date',
        'arrival_date',
        'destination',
        'purpose_of_travel',
        'per_diems_allowed',
        'assistantor_allowed',
        'appropriation',
        'remarks',
    	'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recommended_by',
        'recommemded_at',
        'approved_by',
        'approved_at',
    );

    public $timestamps = false;
}
