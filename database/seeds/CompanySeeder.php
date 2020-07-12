<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('res_companies')->insert([
            'company_name'=> 'My Company',
            'display_name'=> 'My Company',
            'currency_id'=> 12,
            'vat'=> '09.129.294.3-204.000',
            'email'=> 'admin@erpsystem.com',
            'Phone'=> '081243242355',
            'website'=> 'www.mycompany.com',
            'icon'=> 'icon.png',
            'photo'=> 'your_logo.png',
            'street'=> 'Kyobashi MID Bldg., 13-10',
            'street2'=> 'Kyobashi 2-chome',
            'zip'=> '104-0031',
            'city'=> 'Chuo-ku',
            'state_id'=> 243,
            'country_id'=> 113,
            'social_twitter'=> '',
            'social_facebook'=> 'https://twitter.com/kltechgroup/',
            'social_youtube'=> 'https://www.youtube.com/channel/UCftKJ6STypZsVC5bG9mLGXw',
            'social_instagram'=> 'https://www.instagram.com/kelvin_leonardi',
            'social_github'=> 'https://www.github.com/kelvzxu/erp_laravel',
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
    }
}
