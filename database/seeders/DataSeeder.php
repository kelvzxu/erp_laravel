<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            ResCurrencySeeder::class,
            ResCountrySeeder::class,
            ResLangSeeder::class,
            ResPartnerIndustrySeeder::class,

         ]);
    }
}