<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Marquee;

class HomepageController extends Controller
{
    var $projects;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = DB::table('projects')->get();

        return view('homepage.index', compact('projects'));
    }

    public function edit(Project $project)
    {
        return view('homepage.edit', compact('project'));
    }

    public function show()
    {

        return view('homepage.show')->with('popup', 'open');
    }

    public function addlogo(Project $project)
    {
        return view('homepage.addlogo', compact('project'))->with('popup', 'open');
    }

    public function addbanner(Project $project)
    {
        return view('homepage.addbanner', compact('project'))->with('popup', 'open');
    }

    public function addvideo(Project $project)
    {
        return view('homepage.addvideo', compact('project'))->with('popup', 'open');
    }

    public function addannounce(Project $project)
    {
        return view('homepage.addannounce', compact('project'))->with('popup', 'open');
    }

    public function addadvertisting($id, $position)
    {
        $project = DB::table('projects')->where('id', $id)->first();

        return view('homepage.addadvertisting',
                    ['proj_id' => $project->id, 'proj_name' => $project->name, 'position' => $position])
               ->with('popup', 'open');
    }

    public function addinformations(Project $project)
    {
        return view('homepage.addinformations', compact('project'))->with('popup', 'open');
    }

    public function addhelp(Project $project)
    {
        return view('homepage.addhelp', compact('project'))->with('popup', 'open');
    }

    public function addmore(Project $project)
    {
        return view('homepage.addmore', compact('project'))->with('popup', 'open');
    }

    public function addmarquee(Project $project)
    {
        return view('homepage.addmarquee', compact('project'))->with('popup', 'open');
    }

}
