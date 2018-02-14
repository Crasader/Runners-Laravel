<?php

use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder
 * The entry point, this seeder call all the underlying Seeders
 * 
 * @author Bastien Nicoud
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}