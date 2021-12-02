<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('visitor_categories')->insert([
        'title' => 'Посетитель'
      ]);
      DB::table('visitor_categories')->insert([
        'title' => 'Подрядчик'
      ]);
    }
}
