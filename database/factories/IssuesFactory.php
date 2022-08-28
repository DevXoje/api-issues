<?php

namespace Database\Factories;

use App\Models\Departament;
use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;


class IssuesFactory extends Factory
{

    public function definition()
    {
        $departaments = Departament::all();
        $departament_rand = $departaments[rand(0, count($departaments) - 1)];
        return [
            'title' => $this->faker->name(),
            'body' => $this->faker->text(),
            'status' =>  rand(0, count(Issue::$states) - 1),
            'departament' => $departament_rand,
        ];
    }
}
