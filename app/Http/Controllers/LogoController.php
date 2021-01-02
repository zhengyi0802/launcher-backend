<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Project;
use App\Models\Logo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = DB::table('logos')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('logos.*', 'projects.name as proj_name')->paginate(5);

        return view('logos.index',compact('logos'))
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
        return view('logos.create');
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
            'image' => 'required',
            'status' => 'required',
        ]);

        $file = ImageUpload::fileUpload($request);

        if ($file == null) {
            return back()->with('image', $fileName);
        } else {
            $logo = new Logo;
            $logo->proj_id = ($id == null) ? $request->proj_id : $id;
            $logo->name = $request->name;
            $logo->detail = $request->detail;
            $logo->url = $file->file_path;
            $logo->status = $request->status;
            $logo->start_datetime= $request->start_datetime;
            $logo->stop_datetime = $request->stop_datetime;
            $logo->save();
        }

        if ( $id == null ) {
            return redirect()->route('logos.index')
                        ->with('success','Logos created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)
                   ->with('success', 'Logos created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        $project = Project::where('id', $logo->id)->first();

        return view('logos.show',compact('logo'))
               ->with('proj_name', $project->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        //
        $project = Project::where('id', $logo->id)->first();

        return view('logos.edit',compact('logo'))
               ->with('proj_name', $project->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $logo->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $logo->update(['url' => $url]);
            $logo->update();
        }
        //$logo->update($request->all());
        return redirect()->route('logos.index')
                        ->with('success','Logo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        //
        $logo->delete();

        return redirect()->route('logos.index')
                        ->with('success','Logo deleted successfully');
    }

}
