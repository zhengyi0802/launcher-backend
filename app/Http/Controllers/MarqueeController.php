<?php

namespace App\Http\Controllers;

use App\Models\Marquee;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marquees = DB::table('marquees')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('marquees.*', 'projects.name as proj_name')->paginate(5);

        return view('marquees.index',compact('marquees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('marquees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->newstore($request, null);
    }

    public function newstore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'marquee1' => 'required',
            'status' => 'required',
        ]);

        $i = 1;

        $marquee = array(
                'proj_id' => $id,
                'name' => $request->name,
                'index' => $i,
                'marquee' => $request->marquee1,
                'status' => $request->status,
                'start_datetime' => $request->start_datetime,
                'stop_datetime' => $request->stop_datetime,
        );

        Marquee::insert($marquee);

        $i++;
        if ($request->marquee2 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee2;
            Marquee::insert($marquee);
        }

        if ($request->marquee3 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee3;
            Marquee::insert($marquee);
        }
        if ($request->marquee4 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee4;
            Marquee::insert($marquee);
        }
        if ($request->marquee5 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee5;
            Marquee::insert($marquee);
        }
        if ($request->marquee6 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee6;
            Marquee::insert($marquee);
        }
        if ($request->marquee7 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee7;
            Marquee::insert($marquee);
        }
        if ($request->marquee8 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee8;
            Marquee::insert($marquee);
        }
        if ($request->marquee9 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee9;
            Marquee::insert($marquee);
        }
        if ($request->marquee10 != null) {
            $marquee['index'] = ++$i;
            $marquee['marquee'] = $request->marquee10;
            Marquee::insert($marquee);
        }

        if ($id == null) {
            return redirect()->route('marquees.index')
                        ->with('success','Marquees created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Marquees created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function show(Marquee $marquee)
    {
        $project = Project::where('id', $marquee->id)->first();

        return view('marquees.show',compact('marquee'))
               ->with('proj_name', $project->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function edit(Marquee $marquee)
    {
        $project = Project::where('id', $marquee->id)->first();

        return view('marquees.edit',compact('marquee'))
               ->with('proj_name', $project->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marquee $marquee)
    {
        $request->validate([
            'name' => 'required',
            'marquee' => 'required',
            'status' => 'required',
        ]);

        $marquee->update($request->all());

        return redirect()->route('marquees.index')
                        ->with('success','Marquee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marquee $marquee)
    {
        //
        $marquee->delete();

        return redirect()->route('marquees.index')
                        ->with('success','Marquee deleted successfully');
    }

}
