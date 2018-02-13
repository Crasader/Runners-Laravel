<?php

use Illuminate\Database\Seeder;

use App\User;

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
         * Create base users
         * Administrator, Production assistant...
         */
        $root = User::create([
            'name' => 'root',
            'email' => 'root@toor.paleo.ch',
            'password' => bcrypt('secret'),
            'firstname' => 'Root',
            'lastname' => 'Toor',
            'phone_number' => '0794657846',
            'sex' => 'm',
            'status' => 'active'
        ]);

        /**
         * Create runners
         */
    }
}
