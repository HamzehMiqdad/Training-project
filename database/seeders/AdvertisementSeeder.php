<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            'products_top',
            'products_sidebar',
            'products_bottom',
        ];

        foreach ($places as $place) {
            Advertisement::create([
                'owner'      => 'System',
                'link'       => 'https://example.com',
                'place'      => $place,
                'image'      => 'ads/sample-' . $place . '.jpg',
                'hits'       => 0,
                'start_time' => Carbon::now()->subDays(1),
                'end_time'   => Carbon::now()->addDays(30),
            ]);
        }
    }
}
