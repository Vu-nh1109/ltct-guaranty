<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    
    protected $fillable = [
        'order_id',
        'product_id',
        'reason',
        'image1',
        'image2',
        'image3',
        'type',
        'status'
    ];
}
