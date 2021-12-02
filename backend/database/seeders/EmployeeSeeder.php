<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('employees')->insert([
        'last_name' => 'Иванов',
        'name' => 'Иван',
        'middle_name' => 'Иванович',
        'position_id' => '1',
      ]);
      DB::table('employees')->insert([
        'last_name' => 'Сидоров',
        'name' => 'Сидор',
        'middle_name' => 'Сидорович',
        'position_id' => '1',
      ]);
      DB::table('employees')->insert([
        'last_name' => 'Иванов',
        'name' => 'Семен',
        'middle_name' => 'Семенович',
        'position_id' => '3',
      ]);
      DB::table('employees')->insert([
        'last_name' => 'Сидоров',
        'name' => 'Иван',
        'middle_name' => 'Петрович',
        'position_id' => '2',
      ]);
    }
}
