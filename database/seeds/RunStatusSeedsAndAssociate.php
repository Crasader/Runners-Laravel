<?php

use Illuminate\Database\Seeder;

class RunStatusSeedsAndAssociate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        // Create the status
//        $this->call([
//            StatusesTableSeeder::class
//        ]);
        // --> This has already been called into Database

        // Asociate users to base status
        $runs = \App\Run::all();
        $runs->each(function ($user) {
            $user->setStatus('free');
        });
    }
}
