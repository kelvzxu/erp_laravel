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
        DB::table('ir_models')->insert([
            'name' => 'Sales Order',
            'model' => 'sales',
            'info' => 'From quotations to invoices',
            'state' => 'base',
            'icon'=> 'sale.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('ir_models')->insert([
            'name' => 'Purchase',
            'model' => 'purchases',
            'info' => 'Purchase orders, tenders and agreements',
            'state' => 'base',
            'icon' => 'purchase.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('ir_models')->insert([
            'name' => 'Inventory',
            'model' => 'inventory',
            'info' => 'Manage your stock and logistics activities',
            'state' => 'base',
            'icon' => 'inventory.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('ir_models')->insert([
            'name' => 'Accounting',
            'model' => 'accounting',
            'info' => 'Purchase orders, tenders and agreements',
            'state' => 'base',
            'icon' => 'accounting.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('ir_models')->insert([
            'name' => 'Employee',
            'model' => 'human_resources',
            'info' => 'Centralize employee information',
            'state' => 'base',
            'icon' => 'employee.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('ir_models')->insert([
            'name' => 'Point Of Sale',
            'model' => 'point_of_sale',
            'info' => 'User-friendly PoS interface for shops and restaurants',
            'state' => 'base',
            'icon' => 'pos.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
        DB::table('ir_models')->insert([
            'name' => 'Manufacture',
            'model' => 'manufacture',
            'info' => 'Manufacturing Orders & BOMs',
            'state' => 'base',
            'icon' => 'mrp.png',
            'instalation' => false,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ]);
    }
}
