<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert(
            ['name' => 'Internal User']
        );
        DB::table('user_types')->insert(
            ['name' => 'Portal'],
        );
        DB::table('user_groups')->insert(
            ['name' => 'user']
        );
        DB::table('user_groups')->insert(
            ['name' => 'manager'],
        );
    }
}
