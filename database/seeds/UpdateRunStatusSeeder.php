<?php

use Illuminate\Database\Seeder;
use App\Run;
use Carbon\Carbon;

class UpdateRunStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // This seeder will update the status of the run according to its content
        Run::all()->each(function ($run) {
            $diff = $run->planned_at->diffInMinutes(Carbon::now());
            $complete = true;
            foreach ($run->subscriptions as $sub) {
                if (!$sub->car()->exists()) $complete = false;
                if (!$sub->user()->exists()) $complete = false;
            }

            if ($run->planned_at->lt(Carbon::now())) // run in the past
                if ($complete)
                    if ($diff > 60)
                        $run->status = 'finished';
                    else
                        $run->status = 'gone';
                else
                    $run->status = 'error';
            else // run is in the future
                if ($diff > 300) // far in the future
                    $run->status = 'drafting';
                else
                    if ($complete)
                        $run->status = 'ready';
                    else
                        $run->status = 'needs_filling';
            $run->save();
        });
    }
}
