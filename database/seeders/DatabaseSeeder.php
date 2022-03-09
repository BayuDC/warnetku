<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Operator;
use App\Models\Computer;
use App\Models\ComputerType;
use App\Models\RentalPrice;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        Operator::create([
            'username' => 'admin1',
            'password' => bcrypt('admin1')
        ]);
        Operator::create([
            'username' => 'admin2',
            'password' => bcrypt('admin2')
        ]);

        ComputerType::create(['name' => 'Gaming']);
        ComputerType::create(['name' => 'Office']);

        Computer::create([
            'name' => 'PC 1',
            'type_id' => 1
        ]);
        Computer::create([
            'name' => 'PC 2',
            'type_id' => 1
        ]);
        Computer::create([
            'name' => 'PC 3',
            'type_id' => 2
        ]);

        RentalPrice::create([
            'price' => 5000,
            'duration' => 1,
            'type_id' => 1
        ]);
        RentalPrice::create([
            'price' => 9000,
            'duration' => 2,
            'type_id' => 1
        ]);
        RentalPrice::create([
            'price' => 3000,
            'duration' => 1,
            'type_id' => 2
        ]);
        RentalPrice::create([
            'price' => 5000,
            'duration' => 2,
            'type_id' => 2
        ]);
    }
}
