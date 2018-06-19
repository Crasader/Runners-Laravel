<?php

use Illuminate\Database\Seeder;
use App\Schedule;

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
