<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'code_share','user_id'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
    public function get_products_wishlist(){
        return $this->belongsToMany('App\Product','products_wishlists','id_wish','id_product');
    }
}
