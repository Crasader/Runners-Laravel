<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

/**
 * RunsTableSeeder
 * Create runs in the db
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
        // The number of runs you want to generate in the db
        $runsAmount = 60;

        // Festival first day and festival last day
        // use to generate the runs in a known period
        $paleoStartDate = Carbon::createFromFormat('Y-m-d', '2017-07-18');
        $paleoEndDate   = Carbon::createFromFormat('Y-m-d', '2017-07-24');

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

        // The status possible for a run
        $status = collect([
            'drafting',
            'published',
            'finalizing',
            'started',
            'finished',
            'error'
        ]);

        // Create runs randomly using the datas indicated above
        // This seeder only create the run, see the AssociateRunsInfosSeeder to see the cars and runners association to a run

        // TODO:
        // Create the run
        // Associate waypoints
        // Add a status (define the published at if the run is published)
        // Add a planned at and end_planned at

        // We iterates for the amount of runs we want to create (value specified on the top of this class)
        for ($i=0; $i < $runsAmount; $i++) { 

            
        }
    }
}
