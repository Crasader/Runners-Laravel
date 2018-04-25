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
            ['color' => '1abc9c', 'name' => 'A'],
            ['color' => '2ecc71', 'name' => 'B'],
            ['color' => '3498db', 'name' => 'C'],
            ['color' => '9b59b6', 'name' => 'D'],
            ['color' => 'f1c40f', 'name' => 'E'],
            ['color' => 'e67e22', 'name' => 'F'],
            ['color' => 'e74c3c', 'name' => 'G'],
            ['color' => 'ecf0f1', 'name' => 'H'],
            // Coordinators groups
            ['color' => '1abc9c', 'name' => 'C1'],
            ['color' => '2ecc71', 'name' => 'C2'],
            ['color' => '3498db', 'name' => 'C3'],
            ['color' => '9b59b6', 'name' => 'C4'],
            ['color' => 'f1c40f', 'name' => 'C5']
        ];

        /**
         * insert all these groups in the database
         */
        foreach($groups as $group) {
            Group::create($group);
        }
    }
}
