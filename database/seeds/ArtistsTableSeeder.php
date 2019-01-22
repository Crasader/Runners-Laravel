<?php

use Illuminate\Database\Seeder;

use App\Artist;

/**
 * ArtistsTableSeeder
 * Populates the artist table
 *
 * @author Bastien Nicoud
 */
class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Artists to insert in the database
        $artists = [
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
        ];

        // Insert these artists in the database
        foreach ($artists as $artist) {
            Artist::create([
                'name' => $artist
            ]);
        }
    }
}
