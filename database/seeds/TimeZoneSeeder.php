<?php

use Illuminate\Database\Seeder;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = base_path('sql/timezone.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
