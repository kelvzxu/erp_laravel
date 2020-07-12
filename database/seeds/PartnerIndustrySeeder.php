<?php

use Illuminate\Database\Seeder;

class PartnerIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industry = [
            ['industry_name'=>'Agriculture','full_name'=>'A AGRICULTURE, FORESTRY AND FISHING','active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Mining','full_name'=>'B MINING AND QUARRYING', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Manufacturing','full_name'=>'C MANUFACTURING', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Energy supply','full_name'=>'D ELECTRICITY,GAS,STEAM AND AIR CONDITIONING SUPPLY', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Water supply', 'full_name'=>'E WATER SUPPLY;SEWERAGE,WASTE MANAGEMENT AND REMEDIATION ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Construction', 'full_name'=>'F CONSTRUCTION', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Wholesale/Retail', 'full_name'=>'G WHOLESALE AND RETAIL TRADE;REPAIR OF MOTOR VEHICLES AND MOTORCYCLES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Transportation', 'full_name'=>'H TRANSPORTATION AND STORAGE', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Food', 'full_name'=>'I ACCOMMODATION AND FOOD SERVICE ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'IT/Communication', 'full_name'=>'J INFORMATION AND COMMUNICATION', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Finance/Insurance', 'full_name'=>'K FINANCIAL AND INSURANCE ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Real Estate', 'full_name'=>'L REAL ESTATE ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Scientific', 'full_name'=>'M PROFESSIONAL, SCIENTIFIC AND TECHNICAL ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Administrative', 'full_name'=>'N ADMINISTRATIVE AND SUPPORT SERVICE ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Public Administration', 'full_name'=>'O PUBLIC ADMINISTRATION AND DEFENCE;COMPULSORY SOCIAL SECURITY', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Education', 'full_name'=>'P EDUCATION', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Health/Social', 'full_name'=>'Q HUMAN HEALTH AND SOCIAL WORK ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Entertainment', 'full_name'=>'R ARTS, ENTERTAINMENT AND RECREATION', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Other Services', 'full_name'=>'S OTHER SERVICE ACTIVITIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Households', 'full_name'=>'T ACTIVITIES OF HOUSEHOLDS AS EMPLOYERS;UNDIFFERENTIATED GOODS- AND SERVICES-PRODUCING ACTIVITIES OF HOUSEHOLDS FOR OWN USE', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['industry_name'=>'Extraterritorial', 'full_name'=>'U ACTIVITIES OF EXTRA TERRITORIAL ORGANISATIONS AND BODIES', 'active'=>true,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ];

        DB::table('res_partner_industry')->insert($industry);
    }
}
