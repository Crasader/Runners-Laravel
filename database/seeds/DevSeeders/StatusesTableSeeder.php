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
//            [
//                'type'           => 'App\User',
//                'slug'           => 'free',
//                'name'           => 'Disponible',
//                'description'    => 'Utilisateurs disponibles en ce moment.',
//                'shows_on_kiela' => true
//            ],[
//                'type'           => 'App\User',
//                'slug'           => 'requested',
//                'name'           => 'Demandé',
//                'description'    => "Un demande a été faite a cet utilisateur, mais il n'a pas encore répondu.",
//                'shows_on_kiela' => false
//            ],[
//                'type'           => 'App\User',
//                'slug'           => 'not-present',
//                'name'           => 'Pas présent',
//                'description'    => 'Cet utilisateur ne participe pas à cette edition de paléo.',
//                'shows_on_kiela' => false
//            ],[
//                'type'           => 'App\User',
//                'slug'           => 'not-requested',
//                'name'           => 'Non demandé',
//                'description'    => "Aucunne demande de participation n'a été faite pour cet utilisateur.",
//                'shows_on_kiela' => false
//            ],[
//                'type'           => 'App\User',
//                'slug'           => 'taken',
//                'name'           => 'En run',
//                'description'    => 'Utilisateur actuellement en run.',
//                'shows_on_kiela' => true
//            ],
//            [
//                'type'           => 'App\Run',
//                'slug'           => 'free',
//                'name'           => 'Disponible',
//                'description'    => '',
//                'shows_on_kiela' => true
//            ]

            // Run status
            [
                'type'           => 'App\Run',
                'slug'           => 'active',
                'name'           => 'Disponible',
                'description'    => '',
                'shows_on_kiela' => true
            ],[
                'type'           => 'App\Run',
                'slug'           => 'free',
                'name'           => 'Disponible',
                'description'    => "",
                'shows_on_kiela' => true
            ],[
                'type'           => 'App\Run',
                'slug'           => 'accepted',
                'name'           => 'Accepté',
                'description'    => "",
                'shows_on_kiela' => false
            ],[
                'type'           => 'App\Run',
                'slug'           => 'taken',
                'name'           => 'En run',
                'description'    => '',
                'shows_on_kiela' => false
            ],[
                'type'           => 'App\Run',
                'slug'           => 'not-requested',
                'name'           => 'Pas requis',
                'description'    => "",
                'shows_on_kiela' => false
            ],[
                'type'           => 'App\Run',
                'slug'           => 'requested',
                'name'           => 'Demandé',
                'description'    => '',
                'shows_on_kiela' => true
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'not-present',
                'name'           => 'Pas présent',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'free',
                'name'           => 'Libre',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'problem',
                'name'           => 'Problème',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'finished',
                'name'           => 'Terminé',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'empty',
                'name'           => 'Vide',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'needs_filling',
                'name'           => 'A compléter',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'gone',
                'name'           => 'Démarré',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'ready',
                'name'           => 'Prêt',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'drafting',
                'name'           => 'Non publié',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'error',
                'name'           => 'Problème !!',
                'description'    => '',
                'shows_on_kiela' => false
            ],
            [
                'type'           => 'App\Run',
                'slug'           => 'hors_services',
                'name'           => 'Hors service',
                'description'    => '',
                'shows_on_kiela' => false
            ]
        ]);




        // Save all the statuses in the database
        $status->each(function ($status) {
            Status::create($status);
        });
    }
}
