<?php

use Illuminate\Database\Seeder;

use App\Car;
use App\CarType;

/**
 * CarsTableSeeder
 * Create all the cars
 *
 * @author Bastien Nicoud
 */
class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrive the car types to easily attach them after
        $vito  = CarType::where('name', 'VITO')->first();
        $limo  = CarType::where('name', 'LIMO')->first();
        $matos = CarType::where('name', 'MATOS')->first();

        /**
         * 12 Vito bus
         */
        for ($i = 1; $i < 13; $i++) {
            $tmpCar = Car::create([
                'plate_number' => 'AI ' . rand(1000000, 200000),
                'brand'        => 'Mercedes',
                'model'        => 'Vito',
                'color'        => 'noir',
                'status'       => 'free',
                'name'         => "Vito $i"
            ]);
            // Set the car type to $vito
            $tmpCar->type()->associate($vito);
            $tmpCar->save();
        }

        /**
         * 2 Limos
         */
        $tmpLimo = Car::create([
            'plate_number' => 'VD ' . rand(1000000, 500000),
            'brand'        => 'Mercedes',
            'model'        => 'S500',
            'color'        => 'noir',
            'status'       => 'free',
            'name'         => 'Limo 1'
        ]);
        // Set the car type to $limo
        $tmpLimo->type()->associate($limo);
        $tmpLimo->save();

        $tmpLimo = Car::create([
            'plate_number' => 'VD ' . rand(1000000, 500000),
            'brand'        => 'Mercedes',
            'model'        => 'S350',
            'color'        => 'blue',
            'status'       => 'free',
            'name'         => 'Limo 2'
        ]);
        // Set the car type to $limo
        $tmpLimo->type()->associate($limo);
        $tmpLimo->save();

        /**
         * 2 matos
         */
        $tmpMatos = Car::create([
            'plate_number' => 'VD ' . rand(1000000, 500000),
            'brand'        => 'Peugeot',
            'model'        => 'Boxer',
            'color'        => 'white',
            'status'       => 'free',
            'name'         => 'Matos 1'
        ]);
        // Set the car type to $matos
        $tmpMatos->type()->associate($matos);
        $tmpMatos->save();

        $tmpMatos = Car::create([
            'plate_number' => 'VD ' . rand(1000000, 500000),
            'brand'        => 'Peugeot',
            'model'        => 'Kangoo',
            'color'        => 'white',
            'status'       => 'free',
            'name'         => 'Matos 2'
        ]);
        // Set the car type to $matos
        $tmpMatos->type()->associate($matos);
        $tmpMatos->save();
    }
}
