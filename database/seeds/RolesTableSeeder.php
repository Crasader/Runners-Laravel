<?php

use Illuminate\Database\Seeder;

use App\Role;

/**
 * RolesTableSeeder
 * Create all the roles used in the application
 * Note: the admin role can only be added trough the database
 * 
 * @author Bastien Nicoud
 */
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * ROOT the superuser role
         * This user have all access, and it's not possible to remove it's permissions.
         */
        Role::create([
            'name' => 'The superuser',
            'slug' => 'root',
            'permissions' => [
                'start_run'            => true,
                'end_run'              => true,
                'force_start_run'      => true,
                'force_end_run'        => true,
                'manage_runs'          => true,
                'create_users'         => true,
                'delete_users'         => true,
                'manage_schedules'     => true,
                'manage_groups'        => true,
                'manage_cars'          => true,
                'manage_car_types'     => true,
                'manage_other_users'   => true
            ]
        ]);

        /**
         * ADMIN role (basically all the permissions)
         */
        Role::create([
            'name' => 'Runners administrator',
            'slug' => 'admin',
            'permissions' => [
                'start_run'            => true,
                'end_run'              => true,
                'force_start_run'      => true,
                'force_end_run'        => true,
                'manage_runs'          => true,
                'manage_schedules'     => true,
                'manage_groups'        => true,
                'manage_cars'          => true,
                'manage_car_types'     => true,
                'create_users'         => true,
                'delete_users'         => true,
                'manage_other_users'   => true
            ]
        ]);

        /**
         * COORDINATOR role
         */
        Role::create([
            'name' => 'Runners coordinator',
            'slug' => 'coordinator',
            'permissions' => [
                'start_run'            => true,
                'end_run'              => true,
                'force_start_run'      => true,
                'force_end_run'        => true,
                'manage_runs'          => true,
                'manage_schedules'     => true,
                'manage_groups'        => true,
                'manage_cars'          => true,
                'manage_car_types'     => true,
                'create_users'         => true,
                'delete_users'         => false,
                'manage_other_users'   => true
            ]
        ]);

        /**
         * RUNNER role
         */
        Role::create([
            'name' => 'Runner',
            'slug' => 'runner',
            'permissions' => [
                'start_run'            => true,
                'end_run'              => true,
                'force_start_run'      => false,
                'force_end_run'        => false,
                'manage_runs'          => false,
                'manage_schedules'     => false,
                'manage_groups'        => false,
                'manage_cars'          => false,
                'manage_car_types'     => false,
                'create_users'         => false,
                'delete_users'         => false,
                'manage_other_users'   => false
            ]
        ]);
    }
}
