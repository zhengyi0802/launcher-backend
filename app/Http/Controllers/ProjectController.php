<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Startpage;
use App\Models\Logo;
use App\Models\Banner;
use App\Models\Advertisting;
use App\Models\Video;
use App\Models\Announce;
use App\Models\Information;
use App\Models\Help;
use App\Models\More;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::latest()->paginate(5);

        return view('projects.index',compact('projects'))
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
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
                        ->with('success','Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function homepage(Project $project)
    {
        $homepage = $this->getUrls($project->id);
        //var_dump($homepage);
        return view('homepage.edit', compact('project'))->with('homepage', $homepage);
    }

    public function startpage(Project $project)
    {
        $startpage = Startpage::where('proj_id', '=', $project->id)->first();
        if ($startpage == null) {
           $startpage = new Startpage;
        }

        return view('startpages.edit', compact('project'))->with(compact('startpage'));
               //->header('X-Frame-Options', 'allow-from https://www.youtube.com/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
                        ->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $project->delete();

        return redirect()->route('projects.index')
                        ->with('success','Project deleted successfully');
    }


    private function getUrls($id)
    {
         $logo = Logo::where('proj_id', '=', $id)->first();
         $banner = Banner::where('proj_id', '=', $id)->first();
         $advertisting1 = Advertisting::where('proj_id', '=', $id)->where('position', '=', '1')->first();
         $advertisting2 = Advertisting::where('proj_id', '=', $id)->where('position', '=', '2')->first();
         $video = Video::where('proj_id', '=', $id)->first();
         $announce = Announce::where('proj_id', '=', $id)->first();
         $info = Information::where('proj_id', '=', $id)->first();
         $help = Help::where('proj_id', '=', $id)->first();
         $more = More::where('proj_id', '=', $id)->first();
         //$advertisting1 = null;
         //$advertisting2 = null;

         $urls = [
               'logo' => (($logo) ? $logo->toArray() : null),
               'banner' => (($banner) ? $banner->toArray() : null),
               'advertisting1' => (($advertisting1) ? $advertisting1->toArray() : null),
               'advertisting2' => (($advertisting2) ? $advertisting2->toArray() : null),
               'video' => (($video) ? $video->toArray() : null),
               'announce' => (($announce) ? $announce->toArray() : null),
               'info' => (($info) ? $info->toArray() : null),
               'help' => (($help) ? $help->toArray() : null),
               'more' => (($more) ? $more->toArray() : null),
         ];

         return $urls;
    }
}
