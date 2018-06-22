<?php

use Illuminate\Database\Seeder;
use App\Schedule;

/**
 * Specific seeder, he removes all the schedules.
 *
 * @author Bastien Nicoud
 */
class RemoveAllSchedules extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = Schedule::all();
        $schedules->each(function ($schedule) {
            $schedule->delete();
        });
    }
}
