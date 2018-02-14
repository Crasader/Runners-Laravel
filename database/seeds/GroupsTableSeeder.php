<?php

use Illuminate\Database\Seeder;

use App\Group;

/**
 * GroupsTableSeeder
 * Create all the base groups
 * 
 * @author Bastien Nicoud
 */
class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Declare all the groups
         */
        $groups = [
            // Runners groups
            ['color' => 'ff9933', 'name' => 'A'],
            ['color' => 'ffff00', 'name' => 'B'],
            ['color' => 'ff0000', 'name' => 'C'],
            ['color' => '00ffff', 'name' => 'D'],
            ['color' => 'a6a6a6', 'name' => 'E'],
            ['color' => '00ff00', 'name' => 'F'],
            ['color' => 'ff99ff', 'name' => 'G'],
            ['color' => '0033cc', 'name' => 'H'],
            // Coordinators groups
            ['color' => 'dd0806', 'name' => 'C1'],
            ['color' => '1fb714', 'name' => 'C2'],
            ['color' => '3366ff', 'name' => 'C3'],
            ['color' => 'f20884', 'name' => 'C4'],
            ['color' => 'fcf305', 'name' => 'C5']
        ];

        /**
         * insert all these groups in the database
         */
        foreach($groups as $group) {
            Group::create([
                'color' => $group['color'],
                'name'  => $group['name']
            ]);
        }
    }
}
