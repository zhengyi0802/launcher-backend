<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Announce;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $announces = DB::table('announces')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                  ->select('announces.*', 'projects.name as proj_name')->paginate(5);

        return view('announces.index',compact('announces'))
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
        return view('announces.create');
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
        //
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        $file = ImageUpload::fileUpload($request);

        if ($file == null) {
            return back()->with('image', $fileName);
        } else {
            $announce = new Announce;
            $announce->proj_id = ($id==null) ? $request->proj_id : $id;
            $announce->name = $request->name;
            $announce->detail = $request->detail;
            $announce->url = $file->file_path;
            $announce->status = $request->status;
            $announce->start_datetime= $request->start_datetime;
            $announce->stop_datetime = $request->stop_datetime;
            $announce->save();
        }

        if ( $id == null ) {
            return redirect()->route('announces.index')
                        ->with('success','Announces created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Announces created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $announce)
    {
        $project = Project::where('id', $announce->id)->first();

        return view('announces.show',compact('announce'))
               ->with('proj_name', $project->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function edit(Announce $announce)
    {
        //
        $project = Project::where('id', $announce->id)->first();

        return view('announces.edit',compact('announce'))
               ->with('proj_name', $project->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announce $announce)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $announce->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $announce->update(['url' => $url]);
            $announce->update();
        }

        return redirect()->route('announces.index')
                        ->with('success','Announce updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announce $announce)
    {
        //
        $announce->delete();

        return redirect()->route('announces.index')
                        ->with('success','Announce deleted successfully');
    }

}
