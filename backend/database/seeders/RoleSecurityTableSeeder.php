<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSecurityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesSecurities = [];
        $rolesSecurities[] = new RoleSecurity('Начальник охраны', false);
        $rolesSecurities[] = new RoleSecurity('Оператор', false);
        $rolesSecurities[] = new RoleSecurity('Охранник', true);

        foreach ($rolesSecurities as $role) {
            DB::table('role_securities')->insert([
                'title' => $role->title,
                'deletion' => $role->deletion,
            ]);
        }
    }
}

class RoleSecurity
{
    public $title;
    public $deletion;

    public function __construct($title, $deletion)
    {
        $this->title = $title;
        $this->deletion = $deletion;
    }
}
