<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Information;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = DB::table('informations')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('informations.*', 'projects.name as proj_name')->paginate(5);

        return view('infos.index',compact('infos'))
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
        return view('infos.create');
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
            $info = new Information;
            $info->proj_id = ($id == 0) ? $request->proj_id : $id;
            $info->name = $request->name;
            $info->detail = $request->detail;
            $info->url = $file->file_path;
            $info->status = $request->status;
            $info->start_datetime= $request->start_datetime;
            $info->stop_datetime = $request->stop_datetime;
            $info->save();
        }

        if ( $id == null ) {
            return redirect()->route('infos.index')
                        ->with('success','Infos created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Infos created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Information  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Information $info)
    {
       $project = Project::where('id', $info->id)->first();

        return view('infos.show',compact('info'))
               ->with('proj_name', $project->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Information  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $info)
    {
        $project = Project::where('id', $info->id)->first();

        return view('infos.edit',compact('info'))
               ->with('proj_name', $project->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Information  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Information $info)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $info->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $info->update(['url' => $url]);
            $info->update();
        }

        return redirect()->route('infos.index')
                        ->with('success','Info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Information  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $info)
    {
        //
        $info->delete();

        return redirect()->route('infos.index')
                        ->with('success','Info deleted successfully');
    }

}
