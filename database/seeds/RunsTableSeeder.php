<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

/**
 * RunsTableSeeder
 * Create runs in the db
 * 
 * @author Bastien Nicoud
 */
class RunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The number of runs you want to generate in the db
        $runsAmount = 60;

        // Festival first day and festival last day
        // use to generate the runs in a known period
        $paleoStartDate = Carbon::createFromFormat('Y-m-d', '2017-07-18');
        $paleoEndDate   = Carbon::createFromFormat('Y-m-d', '2017-07-24');

        // Artists for which runs will be created
        $artists = collect([
            "RED HOT CHILI PEPPERS",
            "FOALS",
            "KALEO",
            "THE INSPECTOR CLUZO",
            "SATE",
            "TAXIWARS",
            "BARBAGALLO",
            "ALICE ROOSEVELT",
            "FOREIGN DIPLOMATS",
            "THE STACHES",
            "PETIT BISCUIT",
            "CARPENTER BRUT",
            "ISOLATED LINES",
            "LA-33",
            "CERO39",
            "BOOGÁT",
            "ARCADE FIRE",
            "PIXIES",
            "MIDNIGHT OIL",
            "TEMPLES",
            "HER",
            "ORCHESTRE TOUT PUISSANT MARCEL DUCHAMP XXL",
            "HYPERCULTE",
            "LEN SANDER",
            "JULIEN DORÉ",
            "FISHBACH",
            "RADIO ELVIS",
            "RONE",
            "MARABOUT",
            "CELSO PIÑA",
            "SYSTEMA SOLAR",
            "THE GARIFUNA COLLECTIVE",
            "JAMIROQUAI",
            "JUSTICE",
            "JUPITER & OKWESS",
            "NOVA TWINS",
            "POGO CAR CRASH CONTROL",
            "TRYO",
            "VIANNEY",
            "CYRIL MOKAIESH",
            "LOLA MARSH",
            "JÉRÉMIE KISLING",
            "MHD",
            "VALD",
            "ALACLAIR ENSEMBLE",
            "INNA DE YARD",
            "JAH9 & THE DUB TREATMENT",
            "PANTEÓN ROCOCÓ",
            "MACKLEMORE",
            "RYAN LEWIS",
            "BLACK M",
            "GEORGIO ALLTTA",
            "CAMILLE",
            "OCTAVE NOIRE",
            "NICOLAS MICHAUX",
            "ROCKY",
            "MARK KELLY",
            "JALEN N'GONDA",
            "FAI BABA",
            "LOS ORIOLES",
            "AURELIO",
            "KUMBIA BORUKA",
            "ÌFÉ",
            "CHRISTOPHE MAÉ",
            "RENAUD",
            "I MUVRINI",
            "RÉGIS",
            "GAUVAIN SERS",
            "BROKEN BACK",
            "MAT BASTARD",
            "SHAME",
            "ALAN CORBEL",
            "VITALIC ODC LIVE",
            "CLÉMENT BAZIN",
            "MEUTE",
            "BAUCHAMP",
            "ORKESTA MENDOZA",
            "EL FREAKY",
            "KUMBIA BORUKA",
            "MANU CHAO",
            "IMANY",
            "BACHAR MAR-KHALIFÉ",
            "PROFESSOR WOUASSA",
            "KENY ARKANA",
            "KILLASON",
            "KT GORIQUE",
            "FRENCH FUSE",
            "MEUTE",
            "MICHAËL GREGORIO",
            "BOULEVARD DES AIRS",
            "SANDOR",
            "ORCHESTRE DE CHAMBRE DE GENÈVE",
            "CALYPSO ROSE",
            "DELGRÈS",
            "SON DEL SALÓN"
        ]);

        // Little notes to simulate runs notes (randomly assigned to runs)
        // These notes will be assigned to the run via a comment
        $notes = collect([
            'Band départ 11 Pax',
            'Crew départ 1 Pax, 1 VALISE + 1 SAC',
            'invité arrivé 1 Pax',
            'crew départ 1 Pax, 1 grosse valise',
            'agent Départ 1 Pax',
            'band transfert 1 Pax',
            '1 cello / 1 KB flight case / 8 travel',
            'luggages',
            'divers transfert Pax'
        ]);

        // The status possible for a run
        $status = collect([
            'drafting',
            'published',
            'finalizing',
            'started',
            'finished',
            'error'
        ]);

        // Create runs randomly using the datas indicated above
        // This seeder only create the run, see the AssociateRunsInfosSeeder to see the cars and runners association to a run

        // TODO:
        // Create the run
        // Associate waypoints
        // Add a status (define the published at if the run is published)
        // Add a planned at and end_planned at

        // We iterates for the amount of runs we want to create (value specified on the top of this class)
        for ($i=0; $i < $runsAmount; $i++) { 

            
        }
    }
}
