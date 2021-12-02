<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cards')->insert([
        'number' => 10001,
        'card_category_id' => 1,
      ]);
      DB::table('cards')->insert([
        'number' => 10002,
        'card_category_id' => 1,
      ]);
      DB::table('cards')->insert([
        'number' => 20001,
        'card_category_id' => 2,
      ]);
      DB::table('cards')->insert([
        'number' => 20002,
        'card_category_id' => 2,
      ]);

      DB::table('cards')->insert([
        'number' => 30001,
        'card_category_id' => 3,
      ]);
      DB::table('cards')->insert([
        'number' => 30002,
        'card_category_id' => 3,
      ]);
    }
}
