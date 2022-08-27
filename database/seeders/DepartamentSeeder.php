<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departaments_default = [
            [
                'name' => 'Mantenimiento',
                'leader' => 'Gabi'
            ],
            [
                'name' => 'Produccion',
                'leader' => 'Majed'
            ],
        ];
        foreach ($departaments_default as $departament_data) {
            $departament = new Departament($departament_data);
            $departament->save();
        }
    }
}
