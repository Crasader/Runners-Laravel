<?php

use Illuminate\Database\Seeder;

use App\Run;
use App\CarType;
use App\User;
use App\Car;
use App\RunDriver;

/**
 * AssociateCarsToRunSeeder
 * This seeder will associate a car type to a Run
 *
 * @author Xavier Carrel
 */
class AssociateCarsToRunSeeder extends Seeder
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

            while (true)
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

                // Associate the current run to this subscription
                $subscription->run()->associate($run);

                // save the subscription
                $subscription->save();

                if (rand(1,10) < 9) break; // 80% chances that there's no more vehicles
            }

        });
    }
}
