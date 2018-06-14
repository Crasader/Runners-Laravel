<?php

use Illuminate\Database\Seeder;
use App\Run;

/**
 * Specific seeder, he removes all the runs in the database
 *
 * @author Bastien Nicoud
 */
class RemoveAllRunsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all runs
        $runs = Run::all();
        // Iterates trough runs
        $runs->each(function ($run) {
            $run->subscriptions->each(function ($sub) {
                $sub->forceDelete();
            });
            $run->waypoints()->detach();
            $run->artists()->detach();
            $run->forceDelete();
        });
    }
}
