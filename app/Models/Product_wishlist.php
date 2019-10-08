<?php

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Product_wishlist extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = ['id_wish','id_product'];
    protected $table = 'products_wishlists';

    protected $fillable = ['id_wish', 'id_product'];

    protected $hidden = [

    ];

    protected $casts = [

    ];

}
