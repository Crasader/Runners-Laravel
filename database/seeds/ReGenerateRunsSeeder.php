<?php

use Illuminate\Database\Seeder;
use App\Festival;
use App\User;

/**
 * ReGenerateRunsSeeder
 * Re generate fictive runs
 *
 * @author Bastien Nicoud
 */
class ReGenerateRunsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First we remove all runs
        DB::command('DELETE from run_drivers;');
        DB::command('DELETE from artist_run;');
        DB::command('DELETE from run_waypoint;');
        DB::command('DELETE from runs;');

        // Remove edition of festival
        $festivals = Festival::all();
        $festivals->each(function ($festival) {
            $festival->users()->detach();
            $festival->forceDelete();
        });

        // Re generate festival with todays dates
        $this->call([
            FestivalsTableSeeder::class
        ]);

        $users = User::all();
        $users->each(function ($user) {
            $user->festivals()->attach(Festival::first()->id);
        });

        // Re generate runs
        $this->call([
            RunsTableSeeder::class,
            AssociateRunnersAndCarsToRunSeeder::class
        ]);
    }
}
