<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UomSeeder::class,
            AccountSeeder::class,
            AccountTypeSeeder::class,
            AppsSeeder::class,
            CompanySeeder::class,
            CountrySeeder::class,
            CountryStateSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            PartnerIndustrySeeder::class,
            TimeZoneSeeder::class,
            UserSeeder::class,
            UserTypeSeeder::class,
        ]);
    }
}
