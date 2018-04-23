<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Attachment;

/**
 * AttachmentsTableSeeder
 * Create some attachments (driver licence and profile picture)
 * And link it to user
 * 
 * @author Bastien Nicoud
 */
class AttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Count the number of users
        $usersCount = User::all()->count();

        // Create driver licence and profile picture for each user
        for ($i = 1; $i <= $usersCount; $i++) {

            // Retrive the current iterated user
            $user = User::find($i);

            // Create attachment (driver licence and profile picture)
            $profilePicture = new Attachment(['type' => 'profile', 'path' => 'profiles/default.jpg']);
            $driversLicence = new Attachment(['type' => 'licence', 'path' => 'licences/default.jpg']);

            // Set the owner of this attachments
            $profilePicture->owner()->associate($user);
            $driversLicence->owner()->associate($user);
            $profilePicture->save();
            $driversLicence->save();

            // add the attachment of this user
            $user->attachments()->save($profilePicture);
            $user->attachments()->save($driversLicence);
        }
    }
}
