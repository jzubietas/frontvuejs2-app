<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StakeholderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stakeholder_types')->insert([            
            /* tipos de stake holders */
            [
                'name'=>'Promotor',
            ],
            [
                'name'=>'Beneficiario',
            ],            
        ]); 
    }
}
