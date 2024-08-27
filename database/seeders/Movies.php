<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Movies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Children of heaven',
                1997,
                '2018/4/20',
                '22:00'
            ],
            [
                'About Elly',
                2009,
                '2018/4/20',
                '20:00'
            ],
            [
                'A separation',
                2011,
                '2018/4/22',
                '18:00'
            ],
            [
                'The salesman',
                2016,
                '2018/4/21',
                '18:00'
            ],
            [
                'The Elephant king',
                2017,
                '2018/4/21',
                '20:00'
            ]
        ];

        foreach ($data as $item) {

            Movie::query()->create([
                'title' => $item[0],
                'release_year' => $item[1],
                'play_time' => "{$item[2]} {$item[3]}"
            ]);

        }
    }
}
