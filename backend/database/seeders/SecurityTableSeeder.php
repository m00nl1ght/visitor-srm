<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecurityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $securities = [];
        $securities[] = new Security(1, 'Гущин', 'Парамон', 'Павлович');
        $securities[] = new Security(2, 'Цветков', 'Леонид', 'Платонович');
        $securities[] = new Security(3, 'Васильев', 'Макар', 'Аркадьевич');
        $securities[] = new Security(1, 'Зимин', 'Соломон', 'Антонинович');
        $securities[] = new Security(2, 'Крылов', 'Евгений', 'Данилович');
        $securities[] = new Security(3, 'Марков', 'Денис', 'Леонидович');
        $securities[] = new Security(2, 'Ларионов', 'Савелий', 'Юрьевич');
        $securities[] = new Security(3, 'Федотов', 'Ефим', 'Евгеньевич');
        $securities[] = new Security(3, 'Мишин', 'Мечислав', 'Улебович');
        $securities[] = new Security(3, 'Сидоров', 'Витольд', 'Михаилович');

        foreach ($securities as $security) {
            DB::table('securities')->insert([
                'role_security_id' => $security->roleSecurityId,
                'name' => $security->name,
                'last_name' => $security->lastName,
                'middle_name' => $security->middleName
            ]);
        }
    }
}


class Security
{
    public $roleSecurityId;
    public $lastName;
    public $name;
    public $middleName;

    public function __construct
    (
        $roleSecurityId,
        $lastName,
        $name,
        $middleName
    )
    {
        $this->roleSecurityId = $roleSecurityId;
        $this->lastName = $lastName;
        $this->name = $name;
        $this->middleName = $middleName;
    }
}

