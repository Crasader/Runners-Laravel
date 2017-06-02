<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset {--no-seed} {--production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call("db:delete",["--force"=>true]);
        $this->call("migrate");
        if($this->option("no-seed"))
            return true;
        $this->info("populating...");
        if($this->option("production"))
          $this->call("db:seed",["--class"=>"ProductionSeeder"]);
        else
          $this->call("db:seed");
    }
}
