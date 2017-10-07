<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('user_master')->truncate();

      DB::table('user_master')->insert([
         'user_name' => 'admin',
         'email_id' =>'yasin@peerbits.com',
         'password' => md5('123123'),
         'user_type' => 'A',
         'i_by' => '1',
         'u_by' => '1',
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now()
     ]);
    }
}
