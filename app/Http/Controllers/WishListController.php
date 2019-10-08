<?php

namespace App\Http\Controllers;


use App\Models\Product_wishlist;
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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){

        $user = Auth::user();
        //Get Default wishlist
        $default_wishlists = Wishlist::where('user_id','=',$user->id)->first();
        //
        $prod_wishlist = new  Wishlist();
        $listfav = $prod_wishlist->find($default_wishlists->id)->get_products_wishlist()->get();


       return view('wishlist',['products' => $listfav,'code_share' => $default_wishlists->code_share] );
    }

    public function ajax_add_wishProducts(Request $request){
        $user = Auth::user();
        $id_product = $request->post('id_product');
        //retireving default wish...
        $wishlist = DB::table('wishlists')
            ->where('title','=','default')
            ->where('user_id','=',$user->id)
            ->first();

        $wish_product = new Product_wishlist;
        $wish_product->id_wish = $wishlist->id;
        $wish_product->id_product = $id_product;
        if( $wish_product->save() ){
            $response =  ['res'=>'Saved in Wishlist!','id'=> $id_product];
        }else{
            $response =  ['res'=>'Fail to save in Wishlist'];
        }
        return response()->json($response);
    }

    public function ajax_del_wishProducts(Request $request){
        //extract product from wishlist
        $user = Auth::user();
        $id_product = $request->post('id_product');

        $wishlist = DB::table('wishlists')
            ->where('title','=','default')
            ->where('user_id','=',$user->id)
            ->first();
        //get model to delete
        $wish_product = Product_wishlist::where('id_wish','=',$wishlist->id)
        ->where('id_product','=',$id_product);

        if( $wish_product->delete() ){
            $response =  ['res'=>'It is not favorite','id'=> $id_product];
        }else{
            $response =  ['res'=>'Fail delete product of wishlist'];
        }
        return response()->json($response);
    }


    public function share(Request $request,$code){
        //Get wishlist from code
        $default_wishlists = Wishlist::where('code_share','=',$code)->first();
        //
        $prod_wishlist = new  Wishlist();
        $listfav = $prod_wishlist->find($default_wishlists->id)->get_products_wishlist()->get();


        return view('wishlist',['products' => $listfav,'code_share' => $default_wishlists->code_share] );
    }
}
