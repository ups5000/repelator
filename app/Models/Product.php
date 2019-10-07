<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'price', 'updated_at','category','url_orig','img_url'
    ];

    protected $hidden = [

    ];

    protected $casts = [];

}
