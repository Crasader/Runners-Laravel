<?php

use Illuminate\Database\Seeder;

use App\Run;
use App\CarType;
use App\User;
use App\Car;
use App\RunDriver;

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
        // This seeder will associate Runners and car to a Run
        // The seeder ignores collison betwwen availability of each parts
        Run::all()->each(function ($run) {

            // Create new subscription (represented by the run_driver table)
            // In this table we insert the diffrent stakolders for a run
            $subscription = new RunDriver();

            // associate a random user
            $subscription->user()->associate(User::all()->random());

            // Get a type of car
            $carType = CarType::all()->random();

            // Associate this type to the run
            $subscription->carType()->associate($carType);

            // Associate a car with the same type
            $subscription->car()->associate(Car::where('type_id', $carType->id)->get()->random());

            // Associate the current run to this subscription
            $subscription->run()->associate($run);

            // save the subscription
            $subscription->save();

        });
    }
}
