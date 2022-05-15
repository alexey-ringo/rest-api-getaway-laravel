<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_role', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('role_id')->unsigned()->default(1);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->morphs('client');
            $table->unique(['role_id', 'client_type', 'client_id']);
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
        Schema::table('client_role', function (Blueprint $table) {
            $table->dropForeign('client_role_role_id_foreign');
        });
        Schema::dropIfExists('client_role');
    }
}
