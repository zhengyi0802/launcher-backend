<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\More;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mores = DB::table('mores')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('mores.*', 'projects.name as proj_name')->paginate(5);

        return view('mores.index',compact('mores'))
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
        return view('mores.create');
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
            $more = new More;
            $more->proj_id = ($id == null) ? $request->proj_id : $id;
            $more->name = $request->name;
            $more->detail = $request->detail;
            $more->url = $file->file_path;
            $more->status = $request->status;
            $more->start_datetime= $request->start_datetime;
            $more->stop_datetime = $request->stop_datetime;
            $more->save();
        }

        if ( $id == null ) {
            return redirect()->route('mores.index')
                        ->with('success','Mores created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Mores created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\More  $more
     * @return \Illuminate\Http\Response
     */
    public function show(More $more)
    {
        $project = Project::where('id', $more->id)->first();

        return view('mores.show',compact('more'))
               ->with('proj_name', $project->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\More  $more
     * @return \Illuminate\Http\Response
     */
    public function edit(More $more)
    {
        $project = Project::where('id', $more->id)->first();

        return view('mores.edit',compact('more'))
               ->with('proj_name', $project->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, More $more)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $more->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $more->update(['url' => $url]);
            $more->update();
        }

        return redirect()->route('mores.index')
                        ->with('success','More updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\More  $more
     * @return \Illuminate\Http\Response
     */
    public function destroy(More $more)
    {
        //
        $more->delete();

        return redirect()->route('mores.index')
                        ->with('success','More deleted successfully');
    }

}
