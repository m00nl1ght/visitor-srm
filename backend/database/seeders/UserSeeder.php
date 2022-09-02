<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = array(
      [
        'id' => 1,
        'email' => 'admin',
        'password' => Hash::make('admin'),
        'name' => 'admin'
      ],
      [
        'id' => 2,
        'email' => '1@1',
        'password' => Hash::make(1),
        "name" => "User1"
      ],
      [
        'id' => 3,
        'email' => '2@2',
        'password' => Hash::make(2),
        'name' => "User2"
      ],
      [
        'id' => 4,
        'email' => '3@3',
        'password' => Hash::make(3),
        'name' => "User3"
      ]
    );

    $role_users = array(
      [
        'role' => 'admin',
        'user_id' => 1
      ],
      [
        'role' => 'security_chief',
        'user_id' => 2
      ],
      [
        'role' => 'security',
        'user_id' => 3
      ],
      [
        'role' => 'employee',
        'user_id' => 4
      ]
    );

    DB::table('users')->insert($users);
    DB::table('role_users')->insert($role_users);
  }
}
