<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Group;
use App\Festival;
use App\Status;

/**
 * UsersTableSeeder
 * Create all the users in the database.
 *
 * @author Bastien Nicoud
 */
class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Create the superuser
         */
        $root = User::create([
            'name'         => 'Root Toor',
            'email'        => 'root.toor@paleo.ch',
            'password'     => bcrypt('secret'),
            'firstname'    => 'Root',
            'lastname'     => 'Toor',
            'phone_number' => '0794657846',
            'sex'          => 'm'
        ]);
        // Asociate the admin role
        $root->statuses()->save(Status::where([['slug', 'free'], ['type', 'App\User']])->first());
        $root->roles()->save(Role::where('slug', 'root')->first());
        $root->groups()->save(Group::orderBy('id', 'desc')->first());

    }
}
