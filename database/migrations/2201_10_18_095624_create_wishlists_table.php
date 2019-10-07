<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('wishlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('code_share');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlists', function(Blueprint $table)
        {
           $table->dropForeign('wishlists_users_user_id_foreign');
           $table->dropColumn('user_id');
        });
        Schema::dropIfExists('wishlists');
    }
}
