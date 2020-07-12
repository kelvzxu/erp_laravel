<?php

use Illuminate\Database\Seeder;

class CountryStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = base_path('sql/country_state.sql');
        DB::unprepared(file_get_contents($sql));
    }
}
