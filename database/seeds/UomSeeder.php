<?php

use Illuminate\Database\Seeder;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uom_type = [
            ['code'=>'reference','name'=>'Reference Unit of Measure for this category','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['code'=>'smaller','name'=>'Smaller than the reference Unit of Measure','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['code'=>'bigger','name'=>'Bigger than the reference Unit of Measure','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
        ];
        $uom_category = [
            ['name'=>'Unit','measure_type'=>'unit','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Weight','measure_type'=>'weight','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Working Time','measure_type'=>'working_time','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Length / Distance','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'volume','measure_type'=>'volume','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ];
        $uom_uom = [
            ['name'=>'Units','category_id'=>1,'factor'=>1,'rounding'=>0.001,'active'=>true,'uom_type'=>'reference','measure_type'=>'unit','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Dozens','category_id'=>1,'factor'=>0.08333333333333333,'rounding'=>0.01,'active'=>true,'uom_type'=>'bigger','measure_type'=>'unit','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Kg','category_id'=>2,'factor'=>1,'rounding'=>0.001,'active'=>true,'uom_type'=>'reference','measure_type'=>'weight','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'g','category_id'=>2,'factor'=>1000,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'weight','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Days','category_id'=>3,'factor'=>1,'rounding'=>0.01,'active'=>true,'uom_type'=>'reference','measure_type'=>'working_time','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Hours','category_id'=>3,'factor'=>8,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'working_time','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'t','category_id'=>2,'factor'=>0.001,'rounding'=>0.01,'active'=>true,'uom_type'=>'bigger','measure_type'=>'weight','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'m','category_id'=>4,'factor'=>1,'rounding'=>0.01,'active'=>true,'uom_type'=>'reference','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'km','category_id'=>4,'factor'=>0.001,'rounding'=>0.01,'active'=>true,'uom_type'=>'bigger','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'cm','category_id'=>4,'factor'=>100,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Liters','category_id'=>5,'factor'=>1,'rounding'=>0.01,'active'=>true,'uom_type'=>'reference','measure_type'=>'volume','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'lbs','category_id'=>2,'factor'=>2.20462,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'weight','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'ozs','category_id'=>2,'factor'=>35.274,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'weight','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'inches','category_id'=>4,'factor'=>39.3701,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'foot(ft)','category_id'=>4,'factor'=>3.28084,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'miles','category_id'=>4,'factor'=>0.0006213727366498068,'rounding'=>0.01,'active'=>true,'uom_type'=>'bigger','measure_type'=>'length','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'fl oz','category_id'=>5,'factor'=>33.814,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'volume','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'qt','category_id'=>5,'factor'=>1.05669,'rounding'=>0.01,'active'=>true,'uom_type'=>'smaller','measure_type'=>'volume','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'gals','category_id'=>5,'factor'=>0.26417217685798894,'rounding'=>0.01,'active'=>true,'uom_type'=>'bigger','measure_type'=>'volume','create_uid'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ];

        DB::table('uom_uom')->insert($uom_uom);
        DB::table('uom_type')->insert($uom_type);
        DB::table('uom_categories')->insert($uom_category);
    }
}
