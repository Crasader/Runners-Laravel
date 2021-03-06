<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Festival;
use App\Artist;
use App\Run;
use App\Comment;
use App\User;
use App\Waypoint;

/**
 * RunsTableSeeder
 * Create runs in the db
 * This seeder wil generates customs run with randomly generated course and dates
 *
 * @author Bastien Nicoud
 */
class RunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The number of runs you want to generate for each edition of the paleo festival
        $runsAmount = 100;

        // Little notes to simulate runs notes (randomly assigned to runs)
        // These notes will be assigned to the run via a comment
        $notes = collect([
            'Band départ 11 Pax',
            'Crew départ 1 Pax, 1 VALISE + 1 SAC',
            'invité arrivé 1 Pax',
            'crew départ 1 Pax, 1 grosse valise',
            'agent Départ 1 Pax',
            'band transfert 1 Pax',
            '1 cello / 1 KB flight case / 8 travel',
            'luggages',
            'divers transfert Pax'
        ]);

        // The run hour will be picked randomly in this collection
        // Simulate busy hours by repeating them
        $runhours = collect([
            0,0,0,0,
            1,1,1,
            2,2,
            3,
            4,
            5,
            6,
            7,7,
            8,8,
            9,9,
            10,10,
            11,11,
            12,12,
            13,13,13,
            14,14,14,
            15,15,15,15,
            16,16,16,16,
            17,17,17,17,
            18,18,18,18,
            19,19,19,19,
            20,20,20,20,20,
            21,21,21,21,21,
            22,22,22,22,
            23,23,23,23
        ]);

        /**
         * Create runs randomly using the datas indicated above
         * This seeder only create the run, see the AssociateRunsInfosSeeder to see the cars and runners association to a run
         */

        // Get the amounnt of festivals (in the festivals table) to define how many time we have to generates custom runs
        $festivals = Festival::all();

        /**
         * Main loop, iterates for each festival
         */
        $festivals->each(function ($festival) use ($runsAmount, $notes, $runhours) {

            /**
             * Gets datas relatives to all the runs of 1 festival
             */

            // Get the length of the festival
            $festivalLength = $festival->starts_on->diffInDays($festival->ends_on);
            $festivalLengthSoFar = $festival->starts_on->diffInDays(Carbon::now());

            /**
             * Sub-loop
             * We iterates for the amount of runs we want to create (value specified on the top of this class)
             */
            for ($i = 0; $i < $runsAmount; $i++) {


                // TODO:
                //If the run is before the date, his finished
                //If after the date drafting or other status..
                /**
                 * Here we genaerates all the datas for one run
                 */

                // temp var to store the infos of the run in generation
                $run = [];

                // Get the start day of the festival
                $festivalStarts = $festival->starts_on;

                // Select randomly an artist for this run
                $selectedArtist = Artist::all()->random();

                // Sets the run name
                $run['name'] = $selectedArtist->name;

                // Add a note randomly
                $run['infos'] = $notes->random();

                // Sets the run status
                $run['status'] = 'drafting';

                // Sets a number of passanger randomly
                $run['passengers'] = mt_rand(1, 9);

                // Generates the published at
                // Store in tmp var the start day of festival
                $runPublishedTimeTmp = clone $festivalStarts;
                $run['published_at'] = $runPublishedTimeTmp->subDays(mt_rand(1, 50));


                // Generates the planned at
                // Store in tmp var the start day of festival
                $runPlannedTimeTmp = clone $festivalStarts;
                // Chose a day randomly during the festival
                if (mt_rand(0,100) < 90) // 90% runs past or present
                    $runPlannedTimeTmp->addDays(mt_rand(0, $festivalLengthSoFar));
                else // 10% runs future
                    $runPlannedTimeTmp->addDays(mt_rand($festivalLengthSoFar, $festivalLength-$festivalLengthSoFar));
                // Sets the start time randomly (between 08h and 00h00)
                $runPlannedTimeTmp->hour = mt_rand(0, $runhours->random());
                $runPlannedTimeTmp->minute = mt_rand(0, 12)*5;
                $runPlannedTimeTmp->second = 0;
                // Save this time for the start of the run
                $run['planned_at'] = $runPlannedTimeTmp;


                // Generates the en planned for the run (ading 1 to 2 h to the planned_at)
                $runEndPlannedTimeTmp = clone $runPlannedTimeTmp;
                $runEndPlannedTimeTmp->addHours(mt_rand(1,2));
                $runEndPlannedTimeTmp->addMinutes(mt_rand(0,30));
                $run['end_planned_at'] = $runEndPlannedTimeTmp;


                // IF the run is started or finished we have to generate a started_at
                if ($run['status'] === 'gone' || $run['status'] === 'finished') {

                    // create a start time with 0 to 30 minutes of delay from the planned at time
                    $runStartedTimeTmp = clone $runPlannedTimeTmp;
                    $runStartedTimeTmp->addMinutes(mt_rand(0, 30));
                    $run['started_at'] = $runStartedTimeTmp;

                }

                // IF the run is finished we have to generate an ended_at
                if ($run['status'] === 'finished') {

                    // create a start time with 0 to 30 minutes of delay from the planned at time
                    $runEndedAtTimeTmp = clone $runEndPlannedTimeTmp;
                    $runEndedAtTimeTmp->addMinutes(mt_rand(0, 45)-15);
                    $run['ended_at'] = $runEndedAtTimeTmp;

                }

                // Create the run with all the generated datas
                $createdRun = Run::create($run);

                // Assign the artist of this run
                $createdRun->artists()->save($selectedArtist);

                // Sets random waypoints for the run

                $createdRun->waypoints()->save(Waypoint::all()->random(), ['order' => 1]);
                $createdRun->waypoints()->save(Waypoint::all()->random(), ['order' => 2]);
                if (mt_rand(1,8) == 1)
                {
                    $createdRun->waypoints()->save(Waypoint::all()->random(), ['order' => 3]);
                    if (mt_rand(1,8) == 1)
                    {
                        $createdRun->waypoints()->save(Waypoint::all()->random(), ['order' => 4]);
                    }
                }

                // Insert random notes to the run
                // create a comment with a random note and user
                $comment = new Comment(['content' => $notes->random()]);
                $comment->author()->associate(User::all()->random());
                $comment->save();
                // Atach the comment to the run
                $createdRun->comments()->save($comment);

            }
        });
    }
}
