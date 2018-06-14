<?php

use Illuminate\Database\Seeder;

use App\CarType;

/**
 * CarTypesTableSeeder
 * Create all the car types
 *
 * @author Bastien Nicoud
 */
class CarTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 3 base cars types are seeded
        // Vito
        CarType::create([
            "name"        => "VITO",
            "description" => "Bus 9 places pour les runs standard",
            "nb_place"    => 5
        ]);
        // Limo
        CarType::create([
            "name"        => "LIMO",
            "description" => "Limousine pour VIP",
            "nb_place"    => 10
        ]);
        // Matos
        CarType::create([
            "name"        => "MATOS",
            "description" => "Matériel",
            "nb_place"    => 2
        ]);
    }
}
