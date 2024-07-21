<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResPartnerIndustry as PartnerIndustry;
use App\Models\ResPartnerTitle as PartnerTitle;

class ResPartnerIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->CreateResPartnerIndustry();
    }

    public Function CreateResPartnerIndustry()
    {
        $industry_data = $this->ResPartnerIndustryData();
        $title_data = $this->ResPartnerTitleData();
        foreach ($industry_data as $industry) {
            PartnerIndustry::create($industry);
        }
        foreach ($title_data as $title) {
            PartnerTitle::create($title);
        }
    }

    public function ResPartnerIndustryData()
    {
        return [
            ['name'=>'Agriculture','full_name'=>'AGRICULTURE, FORESTRY AND FISHING','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Mining','full_name'=>'MINING AND QUARRYING','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Manufacturing','full_name'=>'MANUFACTURING','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Energy supply','full_name'=>'ELECTRICITY,GAS,STEAM AND AIR CONDITIONING SUPPLY','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Water supply', 'full_name'=>'WATER SUPPLY;SEWERAGE,WASTE MANAGEMENT AND REMEDIATION ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Construction', 'full_name'=>'CONSTRUCTION','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Wholesale/Retail', 'full_name'=>'WHOLESALE AND RETAIL TRADE;REPAIR OF MOTOR VEHICLES AND MOTORCYCLES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Transportation', 'full_name'=>'TRANSPORTATION AND STORAGE','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Food', 'full_name'=>'ACCOMMODATION AND FOOD SERVICE ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'IT/Communication', 'full_name'=>'INFORMATION AND COMMUNICATION','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Finance/Insurance', 'full_name'=>'FINANCIAL AND INSURANCE ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Real Estate', 'full_name'=>'REAL ESTATE ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Scientific', 'full_name'=>'PROFESSIONAL, SCIENTIFIC AND TECHNICAL ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Administrative', 'full_name'=>'ADMINISTRATIVE AND SUPPORT SERVICE ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Public Administration', 'full_name'=>'PUBLIC ADMINISTRATION AND DEFENCE;COMPULSORY SOCIAL SECURITY','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Education', 'full_name'=>'EDUCATION','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Health/Social', 'full_name'=>'HUMAN HEALTH AND SOCIAL WORK ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Entertainment', 'full_name'=>'ARTS, ENTERTAINMENT AND RECREATION','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Other Services', 'full_name'=>'OTHER SERVICE ACTIVITIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Households', 'full_name'=>'ACTIVITIES OF HOUSEHOLDS AS EMPLOYERS;UNDIFFERENTIATED GOODS- AND SERVICES-PRODUCING ACTIVITIES OF HOUSEHOLDS FOR OWN USE','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Extraterritorial', 'full_name'=>'ACTIVITIES OF EXTRA TERRITORIAL ORGANISATIONS AND BODIES','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ];

    }

    public function ResPartnerTitleData(){
        return [
            ['name'=>'Mister', 'shortcut'=>'Mr.', 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Madam', 'shortcut'=>'Mrs.', 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Miss', 'shortcut'=>'Ms.', 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Doctor', 'shortcut'=>'Dr.', 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Professor', 'shortcut'=>'Prof.', 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ];
    }
}