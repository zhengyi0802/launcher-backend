<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Project;
use App\Models\Advertisting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdvertistingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertistings = DB::table('advertistings')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('advertistings.*', 'projects.name as proj_name')->paginate(5);

        return view('advertistings.index',compact('advertistings'))
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
        return view('advertistings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->newstore($request, null, null);
    }

    public function newstore(Request $request, $id, $position)
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
            $advertisting = new Advertisting;
            $advertisting->proj_id = ($id == null) ? $request->proj_id : $id;
            $advertisting->name = $request->name;
            $advertisting->position = ($position == null) ? $request->position : $position;
            $advertisting->detail = $request->detail;
            $advertisting->url = $file->file_path;
            $advertisting->status = $request->status;
            $advertisting->start_datetime= $request->start_datetime;
            $advertisting->stop_datetime = $request->stop_datetime;
            $advertisting->save();
        }

        if ( $id == null ) {
            return redirect()->route('advertistings.index')
                        ->with('success','Advertistings created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Advertistings created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisting  $advertisting
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisting $advertisting)
    {
        $project = Project::where('id', $advertisting->id)->first();

        return view('advertistings.show',compact('advertisting'))
               ->with('proj_name', $project->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisting  $advertisting
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisting $advertisting)
    {
        $project = Project::where('id', $advertisting->id)->first();

        return view('advertistings.edit',compact('advertisting'))
               ->with('proj_name', $project->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisting  $advertisting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisting $advertisting)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'status' => 'required',
        ]);

        $advertisting->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $advertisting->update(['url' => $url]);
            $advertisting->update();
        }

        return redirect()->route('advertistings.index')
                        ->with('success','Advertisting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisting  $advertisting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisting $advertisting)
    {
        //
        $advertisting->delete();

        return redirect()->route('advertistings.index')
                        ->with('success','Advertisting deleted successfully');
    }

}
