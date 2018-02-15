<?php

use Illuminate\Database\Seeder;

use App\Run;

/**
 * AssociateRunnersAndCarsToRunSeeder
 * This seeder will associate Runners and car to a Run according to the availability of each parts
 * 
 * @author Bastien Nicoud
 */
class AssociateRunnersAndCarsToRunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // This seeder will associate Runners and car to a Run according to the availability of each parts
        // TODO:

        // Associate a runner to run
        // Check the planning and vehicle disponibility
        Run::all()->each(function ($run) {
            $run--
        });
    }
}
