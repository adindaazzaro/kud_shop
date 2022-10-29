<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
        ]);
        \App\Models\MProfilApp::create([
            'nama' => 'esto',
            'logo' => '1662113155_logo-esto.png',
            'favicon' => '1662113299_logo-esto.ico',
        ]);
    }
}
