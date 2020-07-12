<?php

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type=[
            ['name'=>'Receivable', 'include_initial_balance'=>true, 'type'=>'receivable', 'internal_group'=>'asset', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Payable', 'include_initial_balance'=>true, 'type'=>'payable', 'internal_group'=>'liability', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Bank and Cash', 'include_initial_balance'=>true, 'type'=>'liquidity', 'internal_group'=>'asset', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Credit Card', 'include_initial_balance'=>true, 'type'=>'liquidity', 'internal_group'=>'liability', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Current Assets', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'asset', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Non-current Assets', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'asset', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Prepayments', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'asset', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Fixed Assets', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'asset', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Current Liabilities', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'liability', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Non-current Liabilities', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'liability', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Equity', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'equity', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Current Year Earnings', 'include_initial_balance'=>true, 'type'=>'other', 'internal_group'=>'equity', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Income', 'include_initial_balance'=>null, 'type'=>'other',  'internal_group'=>'income', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Other Income', 'include_initial_balance'=>null, 'type'=>'other',  'internal_group'=>'income', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Expenses', 'include_initial_balance'=>null, 'type'=>'other',  'internal_group'=>'expense', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Depreciation', 'include_initial_balance'=>null, 'type'=>'other',  'internal_group'=>'expense', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Cost of Revenue', 'include_initial_balance'=>null, 'type'=>'other',  'internal_group'=>'expense', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['name'=>'Off-Balance Sheet', 'include_initial_balance'=>null, 'type'=>'other',  'internal_group'=>'off_balance', 'note'=>null, 'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
        ];

        DB::table('account_account_type')->insert($type);
    }
}
