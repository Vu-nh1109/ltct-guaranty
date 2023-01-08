<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'reason',
        'image1',
        'image2',
        'image3',
        'type'
    ];
}
