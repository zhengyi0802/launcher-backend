<?php

namespace App\Http\Controllers;

use App\Models\Startpage;
use Illuminate\Http\Request;

class StartpageController extends Controller
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
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function show(Startpage $startpage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function edit(Startpage $startpage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startpage $startpage, $id)
    {
        $request->validate([
            'name' => 'required',
            'mime_type' => 'required',
            'status' => 'required',
        ]);

        $startpage->proj_id = $id;
        $startpage->name = $request->name;
        $startpage->mime_type = $request->mime_type;
        $startpage->detail = $request->detail;
        $startpage->url = $file->file_path;
        $startpage->status = $request->status;
        $startpage->start_datetime= $request->start_datetime;
        $startpage->stop_datetime = $request->stop_datetime;

        if ($request->mime_type == 'image') {
            $file = ImageUpload::fileUpload($request);

            if ($file == null) {
                return back()->with('image', $fileName);
            } else {
                $startpage->url = $file->file_path;

            }
        } else {
            $startpage->url = $request->url;
        }

        $startpage->save();

        $project = DB::table('projects')->where("id", $id)->first();

        return redirect()->route('projects.startpage', $id)->with('success', 'Startpage created successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startpage $startpage)
    {
        //
    }
}
