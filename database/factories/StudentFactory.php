<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $agama = $this->faker->randomElement(['Islam', 'Kristen', 'Budha', 'Hindu']);
        $gender = $this->faker->randomElement(['L', 'P']);
        $kelas = (string)rand(10, 12);

        return [
            'nis' => $this->faker->unique()->numerify('########'),
            'name' => $this->faker->name,
            'kelas' => $kelas,
            'agama' => $agama,
            'gender' => $gender,
        ];
    }
}
