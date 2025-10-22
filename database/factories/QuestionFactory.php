<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;

class QuestionFactory extends Factory


{
    protected $model = Question::class;

    public function definition(): array
    {
        $options = [
            'a' => $this->faker->word(),
            'b' => $this->faker->word(),
            'c' => $this->faker->word(),
            'd' => $this->faker->word(),
            'e' => $this->faker->word(),
        ];

        return [
            'question' => $this->faker->sentence(6), // pertanyaan random
            'option_a' => $options['a'],
            'option_b' => $options['b'],
            'option_c' => $options['c'],
            'option_d' => $options['d'],
            'option_e' => $options['e'],
            'answer'   => $this->faker->randomElement(['a','b','c','d','e']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

