<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $agama = $this->faker->randomElement(['Islam', 'Kristen', 'Budha', 'Hindu']);
        $gender = $this->faker->randomElement(['L', 'P']);
        return [
            'nip' => $this->faker->unique()->numerify("##################"),
            'name' => $this->faker->name,
            'agama' => $agama,
            'gender' => $gender,
        ];
    }
}
