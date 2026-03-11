<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{

    public function definition(): array
    {
        return [
            'borrower_name'     => $this->faker->name(),
            'borrower_email'    => $this->faker->unique()->safeEmail(),
            'book_title'        => $this->faker->title(),
            'borrowed_at'       => $this->faker->dateTime(),
            'due_date'          => $this->faker->dateTime(),
            'returned'          => $this->faker->boolean(),
            'status'            => $this->faker->randomElement(['active','returned','overdue']),
        ];
    }
}
