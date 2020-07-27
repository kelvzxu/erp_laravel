<?php

use Illuminate\Database\Seeder;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apps=[
            [
                'name' => 'Sales Order',
                'technical_name'=> 'Sale',
                'model' => 'sales',
                'info' => 'From quotations to invoices',
                'state' => 'base',
                'icon'=> 'sale.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Purchase',
                'technical_name'=> 'Purchase',
                'model' => 'purchase',
                'info' => 'Purchase orders, tenders and agreements',
                'state' => 'base',
                'icon' => 'purchase.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Inventory',
                'technical_name' => 'Inventory',
                'model' => 'inventory',
                'info' => 'Manage your stock and logistics activities',
                'state' => 'base',
                'icon' => 'inventory.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Accounting',
                'technical_name' => 'Accounting',
                'model' => 'accounting',
                'info' => 'Purchase orders, tenders and agreements',
                'state' => 'base',
                'icon' => 'accounting.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Employee',
                'technical_name' => 'hr',
                'model' => 'human_resources',
                'info' => 'Centralize employee information',
                'state' => 'base',
                'icon' => 'employee.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Point Of Sale',
                'technical_name' => 'pos',
                'model' => 'point_of_sale',
                'info' => 'User-friendly PoS interface for shops and restaurants',
                'state' => 'base',
                'icon' => 'pos.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Manufacture',
                'technical_name' => 'mrp',
                'model' => 'manufacture',
                'info' => 'Manufacturing Orders & BOMs',
                'state' => 'base',
                'icon' => 'mrp.png',
                'instalation' => false,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ]
        ];
        $depends=[
            [
                'name' => 'Sale',
                'relation'=> 'Inventory'
            ]
        ];
        DB::table('ir_model_relation')->insert($depends);
        DB::table('ir_models')->insert($apps);
    }
}
