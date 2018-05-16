<?php

use Illuminate\Database\Seeder;

use App\Festival;
use Illuminate\Support\Carbon;
//use Carbon\Carbon;

/**
 * FestivalsTableSeeder
 * Create all the editions of the paleo in the db
 *
 * @author Bastien Nicoud
 */
class FestivalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The festivals we want to insert in the db
        // Possible to insert multiple editions in the db (for multi years, or to do statistics)
        $festivals = [
            //['edition' => '41', 'name' => '40+1',                    'starts_on' => '2016-07-19', 'ends_on' => '2016-07-24'],
            //['edition' => '42', 'name' => '42e Paléo Festival Nyon', 'starts_on' => '2017-07-18', 'ends_on' => '2017-07-23'],
            // Festval from 15 to 19 april, for the demo
            ['edition' => '43', 'name' => '43e Paléo Festival Nyon', 'starts_on' => '2018-05-14', 'ends_on' => '2018-05-19']
        ];

        // insert this festivals in the db
        foreach ($festivals as $festival) {
            Festival::create([
                'edition'   => $festival['edition'],
                'name'      => $festival['name'],
                'starts_on' => Carbon::createFromFormat('Y-m-d', $festival['starts_on']),
                'ends_on'   => Carbon::createFromFormat('Y-m-d', $festival['ends_on'])
            ]);
        }
    }
}
