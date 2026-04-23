<?php

namespace Database\Seeders;

use App\Models\TwoDGameTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TwoDGameTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TwoDGameTime::query()->create([
            'name' => 'AM',
            'end_time' => Carbon::parse('12:00:00', 'Asia/Yangon')
                ->setTimezone('UTC')
                ->toTimeString(), // UTC
            'is_active' => true,
        ]);

        TwoDGameTime::query()->create([
            'name' => 'PM',
            'end_time' => Carbon::parse('15:30:00', 'Asia/Yangon')
                ->setTimezone('UTC')
                ->toTimeString(), // UTC
            'is_active' => true,
        ]);
    }
}
