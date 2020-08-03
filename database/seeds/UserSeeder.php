<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email'=>'admin@erpsystem.com',
            'password'=>Hash::make('admin'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'status' => True,
            'user_type'=> 1,
            'user_groups'=>2,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('hr_employees')->insert([
            'user_id'=> 1,
            'employee_name'=> 'Administrator',
            'identification_id'=> 'super_user',
            'active'=> False,
            'gender'=> 'male',
            'place_of_birth'=> 'Tokyo',
            'country_of_birth'=> 113,
            'address'=> 'Kyobashi MID Bldg., 13-10',
            'street'=> 'Kyobashi 2-chome',
            'zip'=> '104-0031',
            'city'=> 'Chuo-ku',
            'nationality'=> 113,
            'work_phone'=> '017834728',
            'work_email'=> 'admin@erpsystem.com',
            'country_id'=> 113,
            'currency_id'=> 12,
            'state_id'=> 243,
            'birthday'=> date('Y-m-d H:i:s'),
            'salary'=> '3000000',
            'additional_note'=> 'Administrator',
            'certificate'=> 'Barchelor',
            'emergency_contact'=> 'Adinistrator',
            'emergency_phone'=> '01432534',
            'department_id'=> 1,
            'job_id'=> 1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('hr_departments')->insert([
            'department_name' => 'Administrator',
            'complete_name' => 'Administrator',
            'company_id' => 1,
            'manager_id' => 1,
            'note' => 'Administrator',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('hr_jobs')->insert([
            'jobs_name'=> 'Administrator',
            'company_id' => 1,
            'department_id' => 1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('access_rights')->insert([
            'user_id'=>1,
            'administration' => 1
        ]);
    }
}
