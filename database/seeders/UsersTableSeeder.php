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
        DB::table('sys_users')->insert([
            ['name' => 'Administrador', 'email' => 'f1@f1.com', 'password' => bcrypt('123456'), 'created_at' => \Carbon\Carbon::now()],
        ]);               
    }
}
