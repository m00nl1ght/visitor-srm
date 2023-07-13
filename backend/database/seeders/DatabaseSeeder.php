<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(RoleSecurityTableSeeder::class);
        // $this->call(SecurityTableSeeder::class);
        // $this->call(CardCategorySeeder::class);
        // $this->call(CardSeeder::class);
        // $this->call(VisitorCategorySeeder::class);
        // $this->call(SystemAlarmListSeeder::class);
        // $this->call(PositionSeeder::class);
        // $this->call(EmployeeSeeder::class);
        $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        Model::reguard();
    }
}
