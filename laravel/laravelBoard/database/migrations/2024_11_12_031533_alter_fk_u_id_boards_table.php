<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**u_id
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boards', function(Blueprint $table) {
            $table->foreign('u_id')->references('u_id')->on('users');
        });
    }

    /**u_id
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boards', function(Blueprint $table) {
            $table->dropForeign(['u_id']);
        });
    }
};
