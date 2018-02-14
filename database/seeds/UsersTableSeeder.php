<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

/**
 * UsersTableSeeder
 * Create all the users in the database.
 * 
 * @author Bastien Nicoud
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Gets the roles to easily attach them to users in the seeder
         */
        $admin       = Role::where('slug', 'admin')->first();
        $coordinator = Role::where('slug', 'coordinator')->first();
        $runner      = Role::where('slug', 'runner')->first();

        /**
         * Create base users
         * Administrator, Production assistant...
         */
        $root = User::create([
            'name' => 'root',
            'email' => 'root.toor@paleo.ch',
            'password' => bcrypt('secret'),
            'firstname' => 'Root',
            'lastname' => 'Toor',
            'phone_number' => '0794657846',
            'sex' => 'm',
            'status' => 'active'
        ]);
        // Asociate the admin role
        $root->roles()->save($admin);

        /**
         * Create runners
         */
    }
}
