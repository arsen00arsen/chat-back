<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
//        $this->call(AuthorSeeder::class);
        DB::table('users')->insert([
            [
                'name' => "admin",
                'email' => 'admin@admin.com',
                'password' => Hash::make("adminadmin"),
            ],
            [
                'name' => "user",
                'email' => 'user@user.com',
                'password' => Hash::make("useruser"),
            ]
        ]);
    }
}
