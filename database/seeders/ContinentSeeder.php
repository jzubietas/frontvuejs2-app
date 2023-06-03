<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('continents')->insert([
            /*-------------------------*/
            /* Category: Women Clothes */
            /*-------------------------*/

            /* Dresses */
            [
                'continent'=>'America',
                'country'=>'Peru',
            ],
            [
                'continent'=>'Europa',
                'country'=>'Alemania',
            ],
            [
                'continent'=>'Europa',
                'country'=>'Noruega',
            ],
            /*[
                'continent'=>'Asia',
            ],
            [
                'continent'=>'Africa',
            ],*/
            /* Tops */
            /*[
                'continent'=>'Oceania',
            ],*/
            
        ]); 
    }
}
