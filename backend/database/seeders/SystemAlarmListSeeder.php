<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemAlarmListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('system_alarm_lists')->insert([
        'title' => 'Охранная сигнализация'
      ]);
      DB::table('system_alarm_lists')->insert([
        'title' => 'Пожарная сигнализация'
      ]);
      DB::table('system_alarm_lists')->insert([
        'title' => 'Видеонаблюдение'
      ]);
      DB::table('system_alarm_lists')->insert([
        'title' => 'Другое'
      ]);
    }
}
