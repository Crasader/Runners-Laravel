<?php

use Illuminate\Database\Seeder;

use App\Schedule;
use App\Group;
use Carbon\Carbon;

/**
 * SchedulesTableSeeder
 * Create all the base schedules, and associate to id a group
 * 
 * @author Bastien Nicoud
 */
class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Declare all the schedules
         */
        $schedules = [
            // Runners schedules
            // Group A
            ['start_time' => '2017-07-18 07:30', 'end_time' => '2017-07-18 14:30', 'group' => 'A'],
            ['start_time' => '2017-07-23 14:30', 'end_time' => '2017-07-23 22:00', 'group' => 'A'],
            ['start_time' => '2017-07-22 18:00', 'end_time' => '2017-07-23 00:00', 'group' => 'A'],
            ['start_time' => '2017-07-21 22:00', 'end_time' => '2017-07-22 03:00', 'group' => 'A'],
            // Group B
            ['start_time' => '2017-07-19 07:30', 'end_time' => '2017-07-19 14:30', 'group' => 'B'],
            // Coordinator schedule
            // Group C1
            ['start_time' => '2017-07-17 11:00', 'end_time' => '2017-07-17 18:00', 'group' => 'C1'],
        ];

        /**
         * Insert the shedules in the database and link it to the group
         */
        foreach ($schedules as $schedule) {
            // Create the shedule
            $tmp = Schedule::create([
                'start_time' => Carbon::createFromFormat('Y-m-d H:i', $schedule['start_time']),
                'end_time'   => Carbon::createFromFormat('Y-m-d H:i', $schedule['end_time'])
            ]);
            // Associate to the schedule the specified group (by his name)
            $tmp->group()->associate(Group::where('name', $schedule['group'])->first());
            $tmp->save();
        }
    }
}
