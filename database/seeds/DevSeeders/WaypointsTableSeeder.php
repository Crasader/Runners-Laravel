<?php

use Illuminate\Database\Seeder;

use App\Waypoint;

/**
 * WaypointsTableSeeder
 * Seeds the waypoints table
 *
 * @author Bastien Nicoud
 */
class WaypointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // All the waypoints to insert in the DB
        $waypoints = [
            '',
            "Grande scène",
            "Les Arches",
            "Le Dôme",
            "Prod",
            "Honda",
            "Détour",
            "Genève aéroport",
            "Chavannes",
            "Nyon Gare",
            "Lake Geneva Hotel",
            "Cressy",
            "Hilton Genève",
            "Formule 1 Versoix",
            "Best Western Mies",
            "Holiday Inn Coppet"
        ];

        // Insert the waypoints in the db
        foreach($waypoints as $waypoint) {
            Waypoint::create(["name" => $waypoint]);
        }
    }
}
