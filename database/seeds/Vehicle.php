<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicles;

class Vehicle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'vehicle' => 'Semi-trailer truck',
            'total' => '3',
            'default_price' => '60000.00'
        ]);
        
        DB::table('vehicles')->insert([
            'vehicle' => '20 foot swap-body truck',
            'total' => '4',
            'default_price' => '2345.00'
        ]);
        
        
        DB::table('vehicles')->insert([
            'vehicle' => '28.5 foot pup trailer',
            'total' => '5',
            'default_price' => '1225.00'
        ]);
        
    }
}
