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
            ['start_time' => '2017-07-20 23:00', 'end_time' => '2017-07-21 04:00', 'group' => 'A'],
            ['start_time' => '2017-07-20 01:00', 'end_time' => '2017-07-20 08:00', 'group' => 'A'],
            ['start_time' => '2017-07-24 10:00', 'end_time' => '2017-07-24 14:30', 'group' => 'A'],
            // Group B
            ['start_time' => '2017-07-19 07:30', 'end_time' => '2017-07-19 14:30', 'group' => 'B'],
            ['start_time' => '2017-07-18 10:00', 'end_time' => '2017-07-18 17:00', 'group' => 'B'],
            ['start_time' => '2017-07-23 18:00', 'end_time' => '2017-07-24 00:00', 'group' => 'B'],
            ['start_time' => '2017-07-22 22:00', 'end_time' => '2017-07-23 03:00', 'group' => 'B'],
            ['start_time' => '2017-07-21 23:00', 'end_time' => '2017-07-22 04:00', 'group' => 'B'],
            ['start_time' => '2017-07-21 01:00', 'end_time' => '2017-07-21 08:00', 'group' => 'B'],
            ['start_time' => '2017-07-24 10:00', 'end_time' => '2017-07-24 14:30', 'group' => 'B'],
            // Coordinator schedule
            // Group C1
            ['start_time' => '2017-07-17 11:00', 'end_time' => '2017-07-17 18:00', 'group' => 'C1'],
            ['start_time' => '2017-07-18 08:00', 'end_time' => '2017-07-17 14:00', 'group' => 'C1'],
            ['start_time' => '2017-07-23 08:00', 'end_time' => '2017-07-17 14:00', 'group' => 'C1'],
            ['start_time' => '2017-07-22 14:00', 'end_time' => '2017-07-22 20:00', 'group' => 'C1'],
            ['start_time' => '2017-07-21 20:00', 'end_time' => '2017-07-21 23:00', 'group' => 'C1'],
            ['start_time' => '2017-07-20 23:00', 'end_time' => '2017-07-21 02:00', 'group' => 'C1'],
            ['start_time' => '2017-07-20 02:00', 'end_time' => '2017-07-20 08:00', 'group' => 'C1'],
            ['start_time' => '2017-07-24 10:00', 'end_time' => '2017-07-24 15:00', 'group' => 'C1'],
        ];

        /**
         * Insert the shedules in the database and link it to the group
         */
        foreach ($schedules as $schedule) {
            // Create the shedule
            $tmpSchedule = Schedule::create([
                'start_time' => Carbon::createFromFormat('Y-m-d H:i', $schedule['start_time']),
                'end_time'   => Carbon::createFromFormat('Y-m-d H:i', $schedule['end_time'])
            ]);
            // Associate to the schedule the specified group (by his name)
            $tmpSchedule->group()->associate(Group::where('name', $schedule['group'])->first());
            $tmpSchedule->save();
        }
    }
}
