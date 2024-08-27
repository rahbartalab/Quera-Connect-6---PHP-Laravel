<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Seats extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $min = 31;
        $max = 40;

        while ($min <= $max) {
            Seat::query()->create([
                'number' => $min
            ]);
            $min++;
        }
    }
}
