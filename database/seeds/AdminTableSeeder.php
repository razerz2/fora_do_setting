<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'name_full' => 'Admin Full',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'status' => 'ativo'
        ]);
    }
}
