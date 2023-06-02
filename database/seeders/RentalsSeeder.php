<?php

namespace Database\Seeders;

use App\Models\Rentals;
use Illuminate\Database\Seeder;

class RentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rentals::factory()
            ->count(5)
            ->create();
    }
}
