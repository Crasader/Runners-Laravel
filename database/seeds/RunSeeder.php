<?php

use App\User;
use Illuminate\Database\Seeder;

class RunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(!User::all()->count())
            $this->call(UserSeeder::class);
        factory(\App\Run::class,10)->create()->each(function(\App\Run $run){
          $run->waypoints()->attach(factory(\App\Waypoint::class)->create(),["order"=>1]);
          $run->waypoints()->attach(factory(\App\Waypoint::class)->create(),["order"=>2]);
          if(rand() % 2){ //just add some more data
            for($i=0;$i<=5;$i++)
              $run->waypoints()->attach(factory(\App\Waypoint::class)->create(),["order"=>$i + 2]);

          }
        });


    }
}
