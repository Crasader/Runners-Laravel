<?php

use Illuminate\Database\Seeder;

use App\Run;
use App\CarType;
use App\User;
use App\Car;
use App\RunDriver;
use Carbon\Carbon;

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
            do
            {
                // Create new subscription (represented by the run_driver table)
                // In this table we insert the diffrent stakolders for a run
                $subscription = new RunDriver();

                // Get a type of car
                switch (rand(1,10))
                {
                    case 1:
                        $carType = CarType::find(3); // Matos
                        break;
                    case 2:
                        $carType = CarType::find(2); // Limo
                        break;
                    default:
                        $carType = CarType::find(1); // Vito
                        break;
                }

                // Associate this type to the run
                $subscription->carType()->associate($carType);

                if ($run->planned_at->lt(Carbon::now())) // run in the past : must be complete
                {
                    // Associate a car with the same type
                    $subscription->car()->associate(Car::where('type_id', $carType->id)->get()->random());
                    // associate a random user
                    $subscription->user()->associate(User::all()->random());
                }
                else // possibly no car
                {
                    if (rand(1,10) > 6)
                        $subscription->car()->associate(Car::where('type_id', $carType->id)->get()->random());

                    // associate a random user
                    if (rand(1,10) > 6)
                        $subscription->user()->associate(User::all()->random());
                }

                // Associate the current run to this subscription
                $subscription->run()->associate($run);

                // save the subscription
                $subscription->save();

            } while (rand(1,10) >= 8);

        });
    }
}
