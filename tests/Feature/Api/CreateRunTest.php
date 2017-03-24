<?php

namespace Tests\Feature\Api;

use Carbon\Carbon;
use Lib\Models\Run;
use Lib\Models\User;
use Lib\Models\Waypoint;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateRunTest extends TestCase
{
  use DatabaseMigrations;
  public function setUp()
  {
    parent::setUp(); // TODO: Change the autogenerated stub
    //create a user to authenticate
    
  }


  /**
   * Creates a correct run
   * @test
   */
  public function createRun()
  {
    $this->createDefaultUser();
    $date = Carbon::now();
    $waypoints = factory(Waypoint::class,2)->create();
    $res = $this->json("POST","/api/runs",["title"=>"Test run","nb_passenger"=>3,"planned_at"=>$date->toDateString(),"waypoints"=>$waypoints->pluck("id")], ["x-access-token"=>"root"]);
    $res->assertStatus(200)->assertJsonFragment([
      "title"=>"Test run",
      "nb_passenger"=>3
    ]);
    $run = Run::find(1);
    $this->assertEquals($run->name,"Test run");
    $this->assertEquals($run->nb_passenger,3);
  
    $res = $this->json("POST","/api/runs",["artist"=>"Test artist","nb_passenger"=>3,"waypoints"=>$waypoints->pluck("id")], ["x-access-token"=>"root"]);
    $res->assertStatus(200)->assertJsonFragment([
      "title"=>"Test artist",
      "nb_passenger"=>3
    ]);
    $run2 = Run::find(2);
    $this->assertEquals($run2->name,$run2->artist);
  }

  /**
   * This run should fail
   * @test
   */
  public function createRunWithouWaypoints()
  {
    $this->createDefaultUser();
    $date = Carbon::now();
    $res = $this->json("POST","/api/runs",["name"=>"Test run","planned_at"=>$date], ["x-access-token"=>"root"]);
    $res->assertStatus(422)->assertJsonStructure([
      "errors"=>[
        "waypoints",
        "nb_passenger"
      ]
    ]);
  }
}
