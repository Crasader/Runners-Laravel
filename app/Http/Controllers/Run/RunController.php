<?php

namespace App\Http\Controllers\Run;

use App\Run;
use App\Artist;
use App\Waypoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Runs\StoreNewRun;
use App\Http\Requests\Runs\UpdateRun;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Exception;

/**
 * RunController
 *
 * @author Bastien Nicoud
 * @package App\Http\Controllers\Run
 */
class RunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', Run::class);
        $runs = Run::filter($request, 'planned_at', 'asc')->paginate(100);
        return view('runs.index')->with(compact('runs', 'request'));
    }

    /**
     * Display the runs with special layout for big screens
     *
     * @return \Illuminate\Http\Response
     */
    public function big()
    {
        $this->authorize('view', Run::class);
        // Take this opportunity to check if a run is in trouble
        Run::whereNotIn('status', ['finished', 'drafting'])->get()->each(function ($run) {
            $run->updateStatus();
        });
        $runs = Run::where('planned_at', '>=', now())->whereNotIn('status', ['finished', 'drafting'])->orWhere('status','=','error')->orWhere('status','=','gone')
            ->orderBy('planned_at', 'asc')
            ->limit(30)
            ->get();
        return view('runs.big')->with(compact('runs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Run::class);
        $run = Run::create(['status' => 'drafting']);
        $run->waypoints()->attach(1, ['order' => 1]);
        $run->waypoints()->attach(1, ['order' => 2]);
        return redirect()
            ->route('runs.edit', ['run' => $run->id])
            ->with('success', "Le run à correctement été crée");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function show(Run $run)
    {
        $run->updateStatus();
        return view('runs.show')->with(compact('run'));
    }

    /**
     * Display the specified resource for print
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function print(Run $run)
    {
        return view('runs.print')->with(compact('run'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function edit(Run $run)
    {
        $this->authorize('update', $run);
        return view('runs.edit')->with(compact('run'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Runs\UpdateRun $request
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRun $request, Run $run)
    {
        $this->authorize('update', $run);

        // Check usage of action buttons on the form
        if ($this->checkFormActions($request, $run))
        {
            return redirect()->action('Run\RunController@edit', ['run' => $run->id])->withInput();
        }

        // Save alle the run datas and related datas
        $run->saveDatas($request->all());

        return redirect()
            ->route('runs.show', ['run' => $run->id])
            ->with('success', "Le run à correctement été mis a jour.");
    }

    /**
     * Check if actions buttons are used in the view (add waypoint, add run)
     *
     * @param  \App\Http\Requests\Runs\UpdateRun $request
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function checkFormActions($request, $run)
    {
        // Check runners addition
        if ($request->has('add-runner') && $request->input('add-runner', "false") === "true")
        {
            $run->newSubscription();
            return true;
        }
        // Check runners deletion
        if ($request->has('remove-runner'))
        {
            $run->removeSubscription($request->input('remove-runner'));
            return true;
        }
        // Check waypoints additions
        if ($request->has('add-waypoint'))
        {
            $run->newWaypoint($request->input('add-waypoint'));
            return true;
        }
        // Check waypoints removes
        if ($request->has('remove-waypoint'))
        {
            $run->removeWaypoint($request->input('remove-waypoint'));
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $run)
    {
        $this->authorize('delete', $run);
        $run->subscriptions->each(function ($sub) {
            $sub->delete();
        });
        $run->waypoints()->detach();
        $run->artists()->detach();
        $run->delete();
        // We use plain url here to pass the query string parameters
        return redirect('runs?filter-column=status&filter%5B%5D=ready&filter%5B%5D=gone&filter%5B%5D=error&filter%5B%5D=drafting&filter%5B%5D=needs_filling&needle=&search=name')
            // we can change it to ->route('runs.index')
            ->with('success', "Le run $run->name à bien été supprimé.");
    }

    /**
     * Ends the run
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function publish(Run $run)
    {
        $this->authorize('update', $run);
        $run->publish();
        return redirect()
            ->back()
            ->with('success', "Le run $run->name à bien été publié, il est maintenant visible depuis l'app mobile.");
    }

    /**
     * Start the run
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function start(Run $run)
    {
        $this->authorize('start', $run);
        $run->start();
        return redirect()
            ->back()
            ->with('success', "Le run $run->name à bien été démarré !");
    }

    /**
     * Ends the run
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function stop(Run $run)
    {
        $this->authorize('stop', $run);
        $run->stop();
        return redirect()
            ->back()
            ->with('success', "Le run $run->name à bien été arrété !");
    }

    /**
     * Force the start of a run
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function forceStart(Run $run)
    {
        $this->authorize('forceStart', $run);
        $run->forceSart();
        return redirect()
            ->back()
            ->with('warning', "Vous avez forcé le run $run->name à démarrer, malgré des informations manquantes !");
    }

    /**
     * Force the end of a run
     *
     * @param  \App\Run $run
     * @return \Illuminate\Http\Response
     */
    public function forceStop(Run $run)
    {
        $this->authorize('forceStop', $run);
        $run->forceStop();
        return redirect()
            ->back()
            ->with('warning', "Vous avez forcé le run à s'arreter !");
    }

    /**
     * Import runs from CSV file
     */
    public function import()
    {
        return view('runs.import');
    }

    /**
     * Import runs from Excel file using phpspreadsheet https://phpspreadsheet.readthedocs.io/en/develop/
     *
     * Expected structure of the run file:
     *
     * Column A: prodid
     * Column C: name
     * Column F: #pax
     * Column H: date, format m/d/Y
     * Column K: time
     * Column L: from
     * Column M: to
     * Column N+O: transport info
     * Column P: luggage info
     * Column Q+R: contact info
     * Column S: comments
     */
    public function importfile(Request $request)
    {
        $request->file->store('runs');
        $inputFileName = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . 'runs/' . $request->file->hashName();

        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        unset ($sheetData[1]); // disregard column headers
        $rownb = 2; // for error reporting
        $badtrips = array();
        $alreadyimported = array();
        $runs = array();
        foreach ($sheetData as $row)
        {
            extract($row); // $A, $B, ... ,$W

            if (isset($C)) // Artist
            {
                try // We expect at least: Pax, Date, Time, From, To
                {
                    // Check if exists
                    if (Run::where('prodid', '=', intval($A))->count() > 0) throw new Exception("Run déjà importé",1); // code 1 because different list
                    if (!isset($F)) throw new Exception("Pax manque");
                    if (!isset($H)) throw new Exception("Date manque");
                    if (!isset($K)) throw new Exception("Heure manque");
                    if (!isset($L)) throw new Exception("Départ manque");
                    if (!isset($M)) throw new Exception("Arrivée manque");
                    if (!(intval($F) >= 0)) throw new Exception("#Pax ($F)incorrect");
                    try {
                        Carbon::createFromFormat("m/d/Y", "$H"); // will throw exception if data is bad
                    } catch (Exception $ex) {
                        throw new Exception("Mauvais format de date: $H");
                    }
                    $tbc = 0; // time to be confirmed ??
                    try {
                        $start = Carbon::createFromFormat("m/d/Y H:i", "$H $K");
                    } catch (Exception $ex) { // date is OK but time is not --> make it 'tbc'
                        $I = "00:00";
                        $tbc = 1;
                    }
                    unset ($infos);
                    // Build info fields
                    if (isset($N)) // Flight info
                        $infos[] = "Transports: $N $O";
                    if (isset($P)) // Luggage
                        $infos[] = "Bagages: $P";
                    if (isset($Q)) // Contact
                        $infos[] = "Contact: $Q $R";
                    if (isset($S)) // Comments
                        $infos[] = "Divers: $S";

                    $run = Run::create([
                        'prodid' => $A,
                        'name' => $C,
                        'status' => 'drafting',
                        'passengers' => $F,
                        'planned_at' => $start,
                        'tbc' => $tbc,
                        'infos' => implode(" | ", $infos)
                    ]);
                    $run->saveWaypoints(new Collection(array(1 => $L, $M))); // Start at 1 because waypoints are numbered from 1

                    $runs[] = $run;
                }
                catch (\Exception $ex)
                {
                    if ($ex->getCode() == 0)
                        $badtrips[] = "Ligne $rownb, $C, {$ex->getMessage()}";
                    else
                        $alreadyimported[] = "Ligne $rownb, $C, $H $K";
                }
            }
            else
                break; // we stop importing as soon as column C is empty
            $rownb++;
        }
        return view('runs.imported')->with(compact('runs'))->with(compact('badtrips'))->with(compact('alreadyimported'));
    }
}
