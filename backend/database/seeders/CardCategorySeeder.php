<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('card_categories')->insert([
        'title' => 'visitor',
        'description' => 'Посетитель',
      ]);
      DB::table('card_categories')->insert([
        'title' => 'contractor',
        'description' => 'Подрядчик',
      ]);
      DB::table('card_categories')->insert([
        'title' => 'employee',
        'description' => 'Сотрудник',
      ]);
    }
}
