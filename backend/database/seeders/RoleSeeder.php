<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            [
                'title' => 'Админ',
                'slug' => 'admin',
                'description' => null
            ],
            [
                'title' => 'Охранник',
                'slug' => 'security',
                'description' => null
            ],
            [
                'title' => 'Начальник смены охраны',
                'slug' => 'security_chief',
                'description' => null
            ],
            [
              'title' => 'Сотрудник',
              'slug' => 'employee',
              'description' => null
          ],
        );

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'slug' => $role['slug'],
            ], $role);
        }
    }
}
