<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        // generate 3 users/ authors
        DB::table('users')->insert([
            [
                'name' => "John Doe",
                'email' => "johndoe@me.com",
                'password' => bcrypt('test@1234'),
            ],
            [
                'name' => "Admin",
                'email' => "admin@me.com",
                'password' => bcrypt('test@1234'),
            ],
            [
                'name' => "divine",
                'email' => "divine@me.com",
                'password' => bcrypt('test@1234'),
            ],
        ]);
    }
}