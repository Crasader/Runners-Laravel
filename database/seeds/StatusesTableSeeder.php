<?php

use App\Status;
use Illuminate\Database\Seeder;

/**
 * StatusesTableSeeder
 * Stores the status possibles in the app
 *
 * @author Bastien Nicoud
 */
class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = collect([
            // ****************************
            // User status
            [
                'type'           => 'App\User',
                'slug'           => 'free',
                'name'           => 'Disponible',
                'description'    => 'Utilisateurs disponibles en ce moment.',
                'shows_on_kiela' => true
            ],[
                'type'           => 'App\User',
                'slug'           => 'requested',
                'name'           => 'Demandé',
                'description'    => "Un demande a été faite a cet utilisateur, mais il n'a pas encore répondu.",
                'shows_on_kiela' => false
            ],[
                'type'           => 'App\User',
                'slug'           => 'not-present',
                'name'           => 'Pas présent',
                'description'    => 'Cet utilisateur ne participe pas à cette edition de paléo.',
                'shows_on_kiela' => false
            ],[
                'type'           => 'App\User',
                'slug'           => 'not-requested',
                'name'           => 'Non demandé',
                'description'    => "Aucunne demande de participation n'a été faite pour cet utilisateur.",
                'shows_on_kiela' => false
            ],[
                'type'           => 'App\User',
                'slug'           => 'taken',
                'name'           => 'En run',
                'description'    => 'Utilisateur actuellement en run.',
                'shows_on_kiela' => true
            ],
        ]);

        // Save all the statuses in the database
        $status->each(function ($status) {
            Status::create($status);
        });
    }
}
