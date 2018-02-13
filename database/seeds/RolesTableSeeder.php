<?php

use Illuminate\Database\Seeder;

use App\Role;

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
         * Creates the diffrents roles used in the application
         */
        Role::create([
            'name' => 'Runners superuser !',
            'slug' => 'admin'
        ]);
    }
}
