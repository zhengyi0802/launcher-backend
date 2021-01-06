<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Help;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $helps = DB::table('helps')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('helps.*', 'projects.name as proj_name')->paginate(5);

        return view('helps.index',compact('helps'))
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
        return view('helps.create');
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
            $help = new Help;
            $help->proj_id = ($id == null) ? $request->proj_id : $id;
            $help->name = $request->name;
            $help->detail = $request->detail;
            $help->url = $file->file_path;
            $help->status = $request->status;
            $help->start_datetime= $request->start_datetime;
            $help->stop_datetime = $request->stop_datetime;
            $help->save();
        }

        if ( $id == null ) {
            return redirect()->route('helps.index')
                        ->with('success','Helps created successfully.');
        } else {
            $project = DB::table('projects')->where("id", $id)->first();

            return redirect()->route('projects.homepage', $id)->with('success', 'Helps created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function show(Help $help)
    {
        $project = Project::where('id', $help->proj_id)->first();

        return view('helps.show',compact('help'))
               ->with(compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function edit(Help $help)
    {
        $project = Project::where('id', $help->proj_id)->first();

        return view('helps.edit',compact('help'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Help $help)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $help->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $help->update(['url' => $url]);
            $help->update();
        }

        return redirect()->route('helps.index')
                        ->with('success','Help updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function destroy(Help $help)
    {
        //
        $help->delete();

        return redirect()->route('helps.index')
                        ->with('success','Help deleted successfully');
    }

}
