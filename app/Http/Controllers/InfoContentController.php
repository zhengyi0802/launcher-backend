<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Project;
use App\Models\Information;
use App\Models\InformationContent;
use Illuminate\Http\Request;

class InfoContentController extends Controller
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
     * @param  \App\Models\InformationContent  $informationContent
     * @return \Illuminate\Http\Response
     */
    public function show(InformationContent $informationContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InformationContent  $informationContent
     * @return \Illuminate\Http\Response
     */
    public function edit(InformationContent $informationContent)
    {
        //
    }

    public function edit2(Information $info)
    {

        $project = Project::where('id', $info->proj_id)->firstOrFail();
        $infoContent = InformationContent::where('proj_id', $info->proj_id)->first();

        if ($infoContent == null) {
            $infoContent = new InformationContent;
        }

        return view('info_contents.edit2', compact('infoContent'))
               ->with(compact('info'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InformationContent  $informationContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformationContent $informationContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InformationContent  $informationContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformationContent $informationContent)
    {
        //
    }

    public function newstore(Request $request, Information $info)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $insertflag = false;
        $infoContent = InformationContent::where('proj_id', '=', $info->proj_id)->first();
        if ($infoContent == null) {
            $infoContent = new InformationContent;
            $insertflag = true;
        }

        $infoContent->proj_id = $info->proj_id;
        $infoContent->name = $request->name;
        $infoContent->mime_type = $request->mime_type;
        if ($request->url != null) $infoContent->url = $request->url;
        $infoContent->detail = $request->detail;
        $infoContent->status = $request->status;
        $infoContent->start_datetime= $request->start_datetime;
        $infoContent->stop_datetime = $request->stop_datetime;

        if ($request->mime_type == 'image') {
            if ($insertflag || $request->file()) {
                $file = ImageUpload::fileUpload($request);

                if ($file == null) {
                    return back()->with('image', $fileName);
                }
                $infoContent->url = $file->file_path;
            }
        }

        $infoContent->save();

        return redirect()->route('infos.edit', $info)
               ->with('success','Information Content created successfully.');

    }

}
