<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
          'position' => 'Руководитель',
        ]);

        DB::table('positions')->insert([
          'position' => 'Сотрудник',
        ]);

        DB::table('positions')->insert([
          'position' => 'Начальник',
        ]);
    }
}
