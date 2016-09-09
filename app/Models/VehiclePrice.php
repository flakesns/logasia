<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePrice extends Model
{
    protected $table = 'vehicle_price';
    protected $fillable = array('vehicle_id', 'date_avail', 'numb_avail', 'price');
    protected $dates = ['date_avail'];
}
