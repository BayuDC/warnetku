<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Operator;
use App\Models\Computer;
use App\Models\ComputerType;
use App\Models\RentalPrice;
use App\Models\Transaction;
use App\Models\Role;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        Role::factory()->create(['name' => 'Owner']);
        Role::factory()->create(['name' => 'Worker']);

        Operator::factory()->count(5)->sequence(function ($sequnce) {
            return [
                'fullname' => 'Operator ' . $sequnce->index,
                'username' => 'operator' . $sequnce->index,
                'password' => bcrypt('operator' . $sequnce->index),
                'role_id' => $sequnce->index == 0 ? 1 : 2,
            ];
        })->create();

        ComputerType::factory()->create(['name' => 'Gaming']);
        ComputerType::factory()->create(['name' => 'Office']);

        Computer::factory()->count(10)->sequence(function ($sequnce) {
            return [
                'name' => 'Computer ' . ($sequnce->index + 1),
                'type_id' => $sequnce->index < 4 ? 1 : 2,
            ];
        })->create();

        RentalPrice::factory()->create([
            'name' => 'Packet Gaming 1',
            'price' => 5000,
            'duration' => 1,
            'type_id' => 1
        ]);
        RentalPrice::factory()->create([
            'name' => 'Packet Gaming 2',
            'price' => 9000,
            'duration' => 2,
            'type_id' => 1
        ]);
        RentalPrice::factory()->create([
            'name' => 'Packet Gaming 3',
            'price' => 13000,
            'duration' => 3,
            'type_id' => 1
        ]);
        RentalPrice::factory()->create([
            'name' => 'Packet Office 1',
            'price' => 3000,
            'duration' => 1,
            'type_id' => 2
        ]);
        RentalPrice::factory()->create([
            'name' => 'Packet Office 2',
            'price' => 5000,
            'duration' => 2,
            'type_id' => 2
        ]);

        Transaction::factory()->count(rand(100, 120))->create();
    }
}
