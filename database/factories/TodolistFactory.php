<?php

namespace Database\Factories;

use App\Models\Todolist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TodolistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todolist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task' => $this->faker->name
        ];
    }
}
