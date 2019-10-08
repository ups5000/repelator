<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request){

        $order = 'ASC';
        $products = '';
        $listFav = [];

        if( $request->has('sort') ){
            //paginate with sort
            if( $request->sort == 'title' || $request->sort == 'price' )

            $products = DB::table('products')->orderBy($request->get('sort'),$order)->paginate(16);
        }else{
            //no sort
            $products = DB::table('products')->paginate(16);
        }



        //TODO watch Eloquent -> Relationships!!
        //get default wishlist
        if( Auth::check() ){
        $wishlist = DB::table('wishlists')
            ->where('user_id','=', Auth::user()->id)
            ->where('title','=','default')->first();

        //Get all producs in default wishlist to compare
        $listFav = DB::table('products_wishlists')
            ->where('id_wish','=',$wishlist->id)
            ->pluck('id_product')->toArray();
        }

       return view('index',['products' => $products,'inWishlist' => $listFav,'sort'=>$request->get('sort')]);

    }
}
