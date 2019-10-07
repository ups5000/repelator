<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_wishlists', function (Blueprint $table) {
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_wish')->unsigned();
            $table->primary(['id_product','id_wish']);

        });
        Schema::table('products_wishlists',function(Blueprint $table){

            $table->foreign('id_product')
                ->references('id')->on('products');
            $table->foreign('id_wish')
                ->references('id')->on('wishlists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_wishlists', function(Blueprint $table)
        {
            $table->dropForeign('id_product');
            $table->dropIndex('id_product_index');
            $table->dropColumn('id_product');
            $table->dropForeign('id_wish');
            $table->dropIndex('id_wish_index');
            $table->dropColumn('id_wish');


        });
        Schema::dropIfExists('products_whislists');
    }
}
