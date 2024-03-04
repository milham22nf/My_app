<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'm ilham nf',
            'email' => 'muhamadilhamnf@gmail.com',
            'password' => '123',
            'user_name' => 'user45',
            'bio' => 'hi ini aku',
            'status' => 'Aktif',
            'role' => 'user',
            'alamat' => 'Jl mana',
            'no_telp' => '09876',
        ]);
    }
}
