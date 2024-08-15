<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();

        DB::table('products')->insert(array(
            0 =>
            array (

                'id' => 1,
                'name' => 'product1',
                'price' => 100,
                'stock' => 100,
            ),
            1 =>
            array (

                'id' => 2,
                'name' => 'product2',
                'price' => 95,
                'stock' => 95,
            ),
            2 =>
            array (

                'id' => 3,
                'name' => 'product3',
                'price' => 90,
                'stock' => 90,
            ),
            3 =>
            array (

                'id' => 4,
                'name' => 'product4',
                'price' => 85,
                'stock' => 85,
            ),
            4 =>
            array (

                'id' => 5,
                'name' => 'product5',
                'price' => 80,
                'stock' => 80,
            ),
            5 =>
            array (

                'id' => 6,
                'name' => 'product6',
                'price' => 75,
                'stock' => 75,
            ),
            6 =>
            array (

                'id' => 7,
                'name' => 'product7',
                'price' => 70,
                'stock' => 70,
            )
        ));
    }
}
