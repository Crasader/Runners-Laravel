<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Group;

/**
 * UsersTableSeeder
 * Create all the users in the database.
 * 
 * @author Bastien Nicoud
 */
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
         * Create the superuser
         */
        $root = User::create([
            'name'         => 'root',
            'email'        => 'root.toor@paleo.ch',
            'password'     => bcrypt('secret'),
            'firstname'    => 'Root',
            'lastname'     => 'Toor',
            'phone_number' => '0794657846',
            'sex'          => 'm',
            'status'       => 'active',
            'api_token'    => str_random(60)
        ]);
        // Asociate the admin role
        $root->roles()->save(Role::where('slug', 'root')->first());

        /**
         * Create a generic user (for tests)
         */
        $runner = User::create([
            'name'         => 'runner',
            'email'        => 'runner@paleo.ch',
            'password'     => bcrypt('runner'),
            'firstname'    => 'Runner',
            'lastname'     => 'Runner',
            'phone_number' => '0794657846',
            'sex'          => 'm',
            'status'       => 'active',
            'api_token'    => str_random(60)
        ]);
        // Asociate the runner role
        $runner->roles()->save(Role::where('slug', 'runner')->first());

        /**
         * Create users (coordinators, runners)
         * The position of the parameters in the array are important,
         * some propertys are automatically generated in the create procedure, see them below the $users array
         * The default status is 'non-requested'
         * If you specify new groups or roles, don't forget to add it in the corresponding seeders
         */
        $users = [
            // ['lastname', 'firstname', 'phone_number', 'sex', 'group', 'role']
            // Coordinators
            ['Fleischman',    'Roland',      '4749624639', 'm', 'secret', 'C1', 'coordinator'],
            ['Borel',         'Julien',      '4749624639', 'm', 'secret', 'C1', 'coordinator'],
            ['Gautier',       'Nicole',      '4749624639', 'w', 'secret', 'C2', 'coordinator'],
            ['Jung',          'Laurent',     '4749624639', 'm', 'secret', 'C2', 'coordinator'],
            ['Grosjean',      'Daniel',      '4749624639', 'm', 'secret', 'C3', 'coordinator'],
            ['Piguet',        'Floriane',    '4749624639', 'w', 'secret', 'C3', 'coordinator'],
            ['Muller',        'Simone',      '4749624639', 'w', 'secret', 'C4', 'coordinator'],
            ['Mingard',       'Laurent',     '4749624639', 'm', 'secret', 'C4', 'coordinator'],
            ['Chaignat',      'Gérald',      '4749624639', 'm', 'secret', 'C5', 'coordinator'],
            ['Carrel',        'Xavier',      '4749624639', 'm', 'secret', 'C5', 'admin'],
            // Runners
            // Group A
            ['Angiolili',     'Aude',        '4749624639', 'w', 'secret', 'A',  'runner'],
            ['Delacrétaz',    'Nicolas',     '4749624639', 'm', 'secret', 'A',  'runner'],
            ['Fritsché',      'Yves',        '4749624639', 'm', 'secret', 'A',  'runner'],
            ['Ganz',          'Mélanie',     '4749624639', 'w', 'secret', 'A',  'runner'],
            ['Martin',        'Patrick',     '4749624639', 'm', 'secret', 'A',  'runner'],
            // Group B
            ['Lager',         'Michel',      '4749624639', 'm', 'secret', 'B',  'runner'],
            ['Beck',          'Matthieu',    '4749624639', 'm', 'secret', 'B',  'runner'],
            ['Miesegaes',     'Nicolas',     '4749624639', 'm', 'secret', 'B',  'runner'],
            ['Pinilla',       'Christian',   '4749624639', 'm', 'secret', 'B',  'runner'],
            ['Pinilla-Marin', 'Andres',      '4749624639', 'm', 'secret', 'B',  'runner'],
            // Group C
            ['Bourgeois',     'Carole',      '4749624639', 'w', 'secret', 'C',  'runner'],
            ['Courdier',      'Marc',        '4749624639', 'm', 'secret', 'C',  'runner'],
            ['Fleischmann',   'Julien',      '4749624639', 'm', 'secret', 'C',  'runner'],
            ['Gagliardo',     'Serge',       '4749624639', 'm', 'secret', 'C',  'runner'],
            ['Howells',       'Kevin',       '4749624639', 'm', 'secret', 'C',  'runner'],
            ['Rosso',         'Marc',        '4749624639', 'm', 'secret', 'C',  'runner'],
            // Group D
            ['Gauthier',      'Océane',      '4749624639', 'w', 'secret', 'D',  'runner'],
            ['Janin-Cancian', 'Léonore',     '4749624639', 'w', 'secret', 'D',  'runner'],
            ['Janin',         'Héloïse',     '4749624639', 'w', 'secret', 'D',  'runner'],
            ['Lopez',         'Vincent',     '4749624639', 'm', 'secret', 'D',  'runner'],
            ['Rais',          'Sébastien',   '4749624639', 'm', 'secret', 'D',  'runner'],
            // Group E
            ['Colin',         'Jacques',     '4749624639', 'm', 'secret', 'E',  'runner'],
            ['Ducry',         'Jean-Marc',   '4749624639', 'm', 'secret', 'E',  'runner'],
            ['Harb',          'David',       '4749624639', 'm', 'secret', 'E',  'runner'],
            ['Schindler',     'René',        '4749624639', 'm', 'secret', 'E',  'runner'],
            ['Ujvari',        'Laura',       '4749624639', 'w', 'secret', 'E',  'runner'],
            // Group F
            ['Baillif',       'Robin',       '4749624639', 'm', 'secret', 'F',  'runner'],
            ['Berger',        'Sandra',      '4749624639', 'w', 'secret', 'F',  'runner'],
            ['Bernasconi',    'Pierre-Yves', '4749624639', 'm', 'secret', 'F',  'runner'],
            ['Bobillier',     'Vincent',     '4749624639', 'm', 'secret', 'F',  'runner'],
            ['German',        'Eladio',      '4749624639', 'm', 'secret', 'F',  'runner'],
            ['Wolf',          'Julien',      '4749624639', 'm', 'secret', 'F',  'runner'],
            // Group G
            ['Anderes',       'Jean-Marc',   '4749624639', 'm', 'secret', 'G',  'runner'],
            ['Baechler',      'Oliver',      '4749624639', 'm', 'secret', 'G',  'runner'],
            ['Chiabudini',    'Enrico',      '4749624639', 'm', 'secret', 'G',  'runner'],
            ['Comminot',      'Pascal',      '4749624639', 'm', 'secret', 'G',  'runner'],
            ['Gojun',         'Matia',       '4749624639', 'm', 'secret', 'G',  'runner'],
            ['Ramos',         'Joao',        '4749624639', 'm', 'secret', 'G',  'runner'],
            // Group H
            ['Féry-Hammer',   'Christine',   '4749624639', 'm', 'secret', 'H',  'runner'],
            ['Korkia',        'David',       '4749624639', 'm', 'secret', 'H',  'runner'],
            ['Perret',        'Valérie',     '4749624639', 'm', 'secret', 'H',  'runner'],
            ['Pouilly',       'Bertrand',    '4749624639', 'm', 'secret', 'H',  'runner'],
            ['Schumacher',    'Paul',        '4749624639', 'm', 'secret', 'H',  'runner']
        ];

        /**
         * loop all the users and insert it in the database
         */
        foreach ($users as $user) {
            // Create a new user record
            $tmpUser = User::create([
                // The name is generated with fistname and last name (no space, and lowercase)
                'name'         => str_replace(' ', '', strtolower("{$user[0]}{$user[1]}")),
                // The email is also generated with firstname and lastname and with the @test.local prefix
                'email'        => str_replace(' ', '', strtolower("{$user[0]}.{$user[1]}@test.local")),
                'password'     => bcrypt($user[4]),
                'lastname'     => $user[0],
                'firstname'    => $user[1],
                'phone_number' => $user[2],
                'sex'          => $user[3],
                'api_token'    => str_random(60)
            ]);
            // Attach the right role and group for this user
            $tmpUser->roles()->save(Role::where('slug', $user[6])->first());
            $tmpUser->groups()->save(Group::where('name', $user[5])->first());
            // Attatch the 2016 and 2017 edition of pale to this user
            // (for dev we assume all user have participed to all editions)
            $tmpUser->festivals()->attach([1, 2]);
        }
    }
}
