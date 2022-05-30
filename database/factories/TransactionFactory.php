<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $time = $this->faker->randomElement([
            $this->faker->dateTimeBetween('-1 week', '-1 hour'),
            $this->faker->dateTimeThisMonth(),
            $this->faker->dateTimeThisYear(),
            $this->faker->dateTimeThisYear(),
            $this->faker->dateTimeThisYear(),
            $this->faker->dateTimeThisDecade(),
            $this->faker->dateTimeThisDecade(),
            $this->faker->dateTimeThisDecade(),
            $this->faker->dateTimeThisDecade(),
        ]);
        $computerId = $this->faker->numberBetween(1, 10);

        return [
            'customer' => $this->faker->name,
            'time_start' => Carbon::parse($time),
            'time_end' => Carbon::parse($time)->modify('+1 hour'),
            'bill' => $computerId <= 4 ? 5000 : 3000,
            'computer_id' => $computerId,
            'operator_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
