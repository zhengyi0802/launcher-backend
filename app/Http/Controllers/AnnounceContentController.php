<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Project;
use App\Models\Announce;
use App\Models\AnnounceContent;
use Illuminate\Http\Request;

class AnnounceContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnnounceContent  $announceContent
     * @return \Illuminate\Http\Response
     */
    public function show(AnnounceContent $announceContent, Announce $announce)
    {
        $project = Project::where('id', $announce->proj_id)->first();

        return view('announce_contents.show', compact('announceContent'))
               ->with(compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnnounceContent  $announceContent
     * @return \Illuminate\Http\Response
     */
    public function edit2(Announce $announce)
    {

        $project = Project::where('id', $announce->proj_id)->firstOrFail();
        $announceContent = AnnounceContent::where('proj_id', $announce->proj_id)->first();

        if ($announceContent == null) {
            $announceContent = new AnnounceContent;
        }

        return view('announce_contents.edit2', compact('announceContent'))
               ->with(compact('announce'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnnounceContent  $announceContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnnounceContent $announceContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnnounceContent  $announceContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnounceContent $announceContent)
    {
        //
    }

    public function newstore(Request $request, Announce $announce)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $insertflag = false;
        $announceContent = AnnounceContent::where('proj_id', '=', $announce->proj_id)->first();
        if ($announceContent == null) {
            $announceContent = new AnnounceContent;
            $insertflag = true;
        }

        $announceContent->proj_id = $announce->proj_id;
        $announceContent->name = $request->name;
        $announceContent->mime_type = $request->mime_type;
        if ($request->url != null) $announceContent->url = $request->url;
        $announceContent->detail = $request->detail;
        $announceContent->status = $request->status;
        $announceContent->start_datetime= $request->start_datetime;
        $announceContent->stop_datetime = $request->stop_datetime;

        if ($request->mime_type == 'image') {
            if ($insertflag || $request->file()) {
                $file = ImageUpload::fileUpload($request);

                if ($file == null) {
                    return back()->with('image', $fileName);
                }
                $announceContent->url = $file->file_path;
            }
        }

        $announceContent->save();

        return redirect()->route('announces.edit', $announce)
               ->with('success','Announce Content created successfully.');

    }

}
