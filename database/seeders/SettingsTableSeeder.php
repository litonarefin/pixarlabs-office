<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     */
    public function run(): void
    {

        DB::table('settings')->delete();

        DB::table('settings')->insert([
            0 => [
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Site Title',
                'value' => 'Pixarlabs Office',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ],
            1 => [
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Site Description',
                'value' => 'Internal office management system for Pixar Labs - Track team attendance, manage finances, and monitor performance',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ],
            2 => [
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'Google Analytics Tracking ID',
                'value' => null,
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ],
        ]);

    }
}
