<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SchejuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schejules')->insert([
            [
                'event_name' => '春のITカンファレンス2025',
                'event_capacity' => '150',
                'event_price' => 2500.00,
                'event_location' => '東京ビッグサイト',
                'event_description' => '最新のITトレンドを学べる大型イベントです。',
                'event_date' => '2025-05-15',
                'event_start_date' => '2025-05-15 10:00:00',
                'event_end_date' => '2025-05-15 17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_name' => 'Laravelワークショップ',
                'event_capacity' => '30',
                'event_price' => 0.00,
                'event_location' => '渋谷コワーキングスペース',
                'event_description' => '初心者向けLaravel入門講座。',
                'event_date' => '2025-06-01',
                'event_start_date' => '2025-06-01 13:00:00',
                'event_end_date' => '2025-06-01 16:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
