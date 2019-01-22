<?php

use Illuminate\Database\Seeder;
use App\User;

/**
 * FillUsersNameField
 * Updates the name field on user table, for search fields
 *
 * @author Bastien Nicoud
 */
class FillUsersNameField extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $users->each(function ($user) {
            $user->generateName();
            $user->save();
        });
    }
}
