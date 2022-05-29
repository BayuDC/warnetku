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
        $time =  Carbon::parse($this->faker->dateTimeThisMonth('yesterday'));
        $computerId = $this->faker->numberBetween(1, 20);

        return [
            'customer' => $this->faker->name,
            'time_start' => $time,
            'time_end' => $time->addHour(),
            'bill' => $computerId < 8 ? 5000 : 3000,
            'computer_id' => $computerId,
            'operator_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
