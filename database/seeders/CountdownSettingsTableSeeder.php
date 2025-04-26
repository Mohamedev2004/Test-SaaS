<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountdownSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\CountdownSetting::create([
            'original_end_time' => '2025-04-22 20:00:00',
            'current_end_time' => '2025-04-22 20:00:00',
            'extension_minutes' => 0
        ]);
    }
}
