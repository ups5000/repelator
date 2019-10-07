<?php

namespace App\Http\Controllers;

use App\Product_wishlist;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){

       $products = DB::table('products')->paginate(16);
       return view('index',['products' => $products]);

    }
    public function add_wish(Request $request){
        $auth_user = Auth::user();
        $id_product = $request->post('id_product');
        //retireving default wish...
        $wishlist = Wishlist::where(
            ['title','default'],
            ['user_id',$auth_user->id] )->first();

        $wish_product = new Product_wishlist;
        $wish_product->id_wish = $wishlist->id;
        $wish_product->id_product = $id_product;
        if( $wish_product->save() ){
            $response =  response()->json(['res'=>'Saved in Wishlist!']);
        }else{
            $response =  response()->json(['res'=>'Fail to save in Wishlist']);
        }

    }
}
