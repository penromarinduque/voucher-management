<?php

namespace App\Models\denr;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table= 'itinerary';
    protected $fillable = array(
    	'id',
        'order_no',
        'user_id',
        'it_date',
        'it_place',
        'it_departure',
        'it_arrival',
        'it_means_of_trn',
        'it_fare',
        'it_per_diems',
        'it_allowance',
    );

    public $timestamps = false;
}
