<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ImageUpload;
use App\Models\File;
use App\Models\Banner;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = DB::table('banners')->leftJoin('projects', 'proj_id', '=', 'projects.id')
                 ->select('banners.*', 'projects.name as proj_name')->paginate(5);

        return view('banners.index',compact('banners'))
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
        return view('banners.create');
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
            $banner = new Banner;
            $banner->proj_id = ($id == 0) ? $request->proj_id : $id;
            $banner->name = $request->name;
            $banner->detail = $request->detail;
            $banner->url = $file->file_path;
            $banner->status = $request->status;
            $banner->start_datetime= $request->start_datetime;
            $banner->stop_datetime = $request->stop_datetime;
            $banner->save();
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
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        $project = Project::where('id', $banner->proj_id)->first();

        return view('banners.show',compact('banner'))
               ->with(compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $project = Project::where('id', $banner->proj_id)->first();

        return view('banners.edit',compact('banner'))
               ->with(compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $banner->update($request->all());
        if ($request->file()) {
            $file = ImageUpload::fileUpload($request);
            $url = $file->file_path;
            $banner->update(['url' => $url]);
            $banner->update();
        }

        return redirect()->route('banners.index')
                        ->with('success','Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
        $banner->delete();

        return redirect()->route('banners.index')
                        ->with('success','Banner deleted successfully');
    }

}
