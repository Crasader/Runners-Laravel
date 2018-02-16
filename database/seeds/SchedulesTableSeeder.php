<?php

use Illuminate\Database\Seeder;

use App\Schedule;
use App\Group;
use App\Festival;
use Carbon\Carbon;

/**
 * SchedulesTableSeeder
 * Create all the base schedules, and associate to id a group
 * This seeder can generate randoms shedules or use the shedules filled in the $shedules array
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
        // set the type of generation (random or specified)
        $generateSchedules = 'random';

        /**
         * Declare all the schedules (if you don't use the random generator)
         */
        $schedules = [
            // Paleo edition 2017
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
         * Schedules random generator
         * If you select the random mode -> launch the generator
         */
        if ($generateSchedules === 'random') {

            // Empty the shedule array
            $schedules = [];

            // Get the amounnt of festivals (in the festivals table) to define how many shedules to generates
            $festivalsAmount = Festival::all()->count();

            /**
             * Main loop, iterates for each festival
             */
            for ($f = 1; $f <= $festivalsAmount; $f++) {

                // Gets the festival we actually iterates trough
                $festival = Festival::find($f);

                // Get the length of the festival
                $festivalLength = $festival->starts_on->diffInDays($festival->ends_on);

                // Sets a var to cout the groups used for the generation
                $groupCount = 1;
                $coordinatorGroupCount = 9;

                /**
                 * Iterates each days to generate a custom shedules
                 */
                for ($d = 0; $d <= $festivalLength; $d++) {

                    // Get the current day
                    $dayDate = clone $festival->starts_on;
                    $dayDate->addDays($d);
                    // Sets the day time to 6h (the first group of day start time)
                    $dayDate->hour = 6;
                    $dayDate->minute = 0;
                    $dayDate->second = 0;

                    /**
                     * Iterates to generate 6 runners group shedule per day
                     */
                    for ($sr = 0; $sr < 5; $sr++) {

                        // Temp array to store the current generated schedule
                        $generatedSchedule = [];

                        // Get the base dateTime (for this day)
                        $sheduleTime = clone $dayDate;

                        // Sets the start time of the shedule
                        $generatedSchedule['start_time'] = $sheduleTime->addHours($sr * 3)->format('Y-m-d H:i');
                        // Sets the end time of the schedule
                        $generatedSchedule['end_time'] = $sheduleTime->addHours(6)->format('Y-m-d H:i');
                        // Sets the group
                        $generatedSchedule['group'] = Group::find($groupCount)->name;

                        // Adds the generated shedule to array of shedules
                        array_push($schedules, $generatedSchedule);

                        // Resets the group count
                        $groupCount === 8 ? $groupCount = 1 : $groupCount++;

                    }

                    /**
                     * Iterates to generate 2 coordinators group shedule per days
                     */
                    for ($sc = 0; $sc < 2; $sc++) {

                        // Temp array to store the current generated schedule
                        $generatedSchedule = [];

                        // Get the base dateTime (for this day)
                        $coordinatorSheduleTime = clone $dayDate;

                        // Sets the start time of the shedule
                        $generatedSchedule['start_time'] = $coordinatorSheduleTime->addHours($sc * 8)->format('Y-m-d H:i');
                        // Sets the end time of the schedule
                        $generatedSchedule['end_time'] = $coordinatorSheduleTime->addHours(10)->format('Y-m-d H:i');
                        // Sets the group
                        $generatedSchedule['group'] = Group::find($coordinatorGroupCount)->name;

                        // Adds the generated shedule to array of shedules
                        array_push($schedules, $generatedSchedule);

                        // Resets the group count
                        $coordinatorGroupCount === 13 ? $coordinatorGroupCount = 9 : $coordinatorGroupCount++;

                    }
                }
            }
        }


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
