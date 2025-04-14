<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schejule extends Model
{

    protected $table = 'schejules';
    protected $primaryKey = 'schejules_id';

    // マスアサインメントを許可する属性を指定
    protected $fillable = [
        'event_name', 
        'event_date', 
        'event_start_date', 
        'event_end_date', 
        'event_description', 
        'event_location', 
        'event_price', 
        'event_capacity'
    ];
}
