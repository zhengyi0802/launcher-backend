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
    public function newstore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        $file = ImageUpload::fileUpload($request);

        if ($file == null) {
            return back()->with('image', $fileName);
        } else {
            $startpage = new Startpage;
            $startpage->proj_id = ($id == 0) ? $request->proj_id : $id;
            $startpage->name = $request->name;
            $startpage->mime_type = $request->mime_type;
            $startpage->detail = $request->detail;
            $startpage->url = $file->file_path;
            $startpage->status = $request->status;
            $startpage->start_datetime= $request->start_datetime;
            $startpage->stop_datetime = $request->stop_datetime;
            $startpage->save();
        }

        if ( $id == null ) {
            return redirect()->route('banners.index')
                        ->with('success','Banners created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Banners created successfully.');
        }

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
