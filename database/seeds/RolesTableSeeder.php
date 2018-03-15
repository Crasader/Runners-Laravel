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
                'create_runners'       => true,
                'create_coordinators'  => true,
                'create_admin'         => true,
                'destroy_runners'      => true,
                'destroy_coordinators' => true,
                'destroy_admin'        => true,
                'manage-schedules'     => true
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
                'create_runners'       => true,
                'create_coordinators'  => true,
                'create_admin'         => false,
                'destroy_runners'      => true,
                'destroy_coordinators' => true,
                'destroy_admin'        => false,
                'manage-schedules'     => true
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
                'create_runners'       => true,
                'create_coordinators'  => false,
                'create_admin'         => false,
                'destroy_runners'      => true,
                'destroy_coordinators' => false,
                'destroy_admin'        => false,
                'manage-schedules'     => true
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
                'create_runners'       => false, 
                'create_coordinators'  => false,
                'create_admin'         => false,
                'destroy_runners'      => false,
                'destroy_coordinators' => false,
                'destroy_admin'        => false,
                'manage-schedules'     => false
            ]
        ]);
    }
}
