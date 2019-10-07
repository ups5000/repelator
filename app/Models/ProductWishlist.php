<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWishlist extends Model
{
    protected $primaryKey = ['id_wish','id_product'];
    protected $table = 'products_wishlists';

    protected $fillable = [
        'id_wish', 'id_product'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
