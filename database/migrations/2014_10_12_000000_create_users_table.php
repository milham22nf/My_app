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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->char('user_name')->nullable();
            $table->integer('no_telp');
            $table->text('alamat')->nullable();
            $table->text('bio')->nullable();
            $table->string('picture')->nullable();
            $table->enum('status',['Aktif', 'NonAktif'])->default('Aktif');
            $table->enum('role',['user','admin'])->default('user');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
