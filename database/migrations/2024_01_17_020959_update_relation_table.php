<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDeleteCascade()->onUpdateCascade();
        });

        Schema::table('fotos', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDeleteCascade()->onUpdateCascade();
            $table->foreign('id_album')->references('id')->on('albums')->onDeleteCascade()->onUpdateCascade();
        });

        Schema::table('komentars', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDeleteCascade()->onUpdateCascade();
            $table->foreign('id_foto')->references('id')->on('fotos')->onDeleteCascade()->onUpdateCascade();
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDeleteCascade()->onUpdateCascade();
            $table->foreign('id_foto')->references('id')->on('fotos')->onDeleteCascade()->onUpdateCascade();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
