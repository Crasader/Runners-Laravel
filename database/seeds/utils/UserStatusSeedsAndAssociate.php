<?php

use Illuminate\Database\Seeder;
use App\User;

/**
 * Specific seeder, he just create the status and asociate the default mot-requested status to the existing users
 *
 * @author Bastien Nicoud
 */
class UserStatusSeedsAndAssociate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the status
        $this->call([
            StatusesTableSeeder::class
        ]);

        // Asociate users to base status
        $users = User::all();
        $users->each(function ($user) {
            $user->setStatus('free');
        });
    }
}
