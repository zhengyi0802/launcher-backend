<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = DB::table('videos')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('videos.*', 'projects.name as proj_name')->paginate(5);

        return view('videos.index',compact('videos'))
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
        return view('videos.create');
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
            'url' => 'required',
            'status' => 'required',
        ]);

        $video = new Video;
        $video->proj_id = ($id == null) ? $request->proj_id : $id;
        $video->name = $request->name;
        $video->detail = $request->detail;
        $video->url = $request->url;
        $video->status = $request->status;
        $video->start_datetime= $request->start_datetime;
        $video->stop_datetime = $request->stop_datetime;
        $video->save();

        if ( $id == null ) {
            return redirect()->route('videos.index')
                        ->with('success','Videos created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)
                   ->with('success', 'Videos created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $project = Project::where('id', $video->proj_id)->first();

        return view('videos.show',compact('video'))
               ->with(compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
        $project = Project::where('id', $video->proj_id)->first();

        return view('videos.edit',compact('video'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'name' => 'required',
            'url'  => 'required',
            'status' => 'required',
        ]);

        $video->update($request->all());

        return redirect()->route('videos.index')
                        ->with('success','Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
        $video->delete();

        return redirect()->route('videos.index')
                        ->with('success','Video deleted successfully');
    }

}
