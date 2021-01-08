<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Logo;
use App\Models\Banner;
use App\Models\Advertisting;
use App\Models\Video;
use App\Models\Announce;
use App\Models\Information;
use App\Models\Help;
use App\Models\More;
use App\Models\Marquee;
use App\Models\Product;

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
        $logo = Logo::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addlogo', compact('project'))
               ->with(compact('logo'))
               ->with('popup', 'open');
    }

    public function addbanner(Project $project)
    {
        $banner = Banner::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addbanner', compact('project'))
               ->with(compact('banner'))
               ->with('popup', 'open');
    }

    public function addvideo(Project $project)
    {
        $video = Video::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addvideo', compact('project'))
               ->with(compact('video'))
               ->with('popup', 'open');
    }

    public function addannounce(Project $project)
    {
        $announce = Announce::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addannounce', compact('project'))
               ->with(compact('announce'))
               ->with('popup', 'open');
    }

    public function addadvertisting($id, $position)
    {
        $project = DB::table('projects')->where('id', $id)->latest()->get()->first();
        $advertisting1 = Advertisting::where('proj_id', '=', $id)->where('position', '=', '1')->first();
        $advertisting2 = Advertisting::where('proj_id', '=', $id)->where('position', '=', '2')->first();
        return view('homepage.addadvertisting',
                    ['proj_id' => $project->id, 'proj_name' => $project->name, 'position' => $position])
               ->with(compact('advertisting1'))
               ->with(compact('advertisting2'))
               ->with('popup', 'open');
    }

    public function addinformations(Project $project)
    {
        $info = Information::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addinformations', compact('project'))
               ->with(compact('info'))
               ->with('popup', 'open');
    }

    public function addhelp(Project $project)
    {
        $help = Help::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addhelp', compact('project'))
               ->with(compact('help'))
               ->with('popup', 'open');
    }

    public function addmore(Project $project)
    {
        $more = More::where('proj_id', '=', $project->id)->latest()->get()->first();

        return view('homepage.addmore', compact('project'))
               ->with(compact('more'))
               ->with('popup', 'open');
    }

    public function addmarquee(Project $project)
    {
        return view('homepage.addmarquee', compact('project'))->with('popup', 'open');
    }

    public function query(Request $request)
    {
        //var_dump($request);
        if ($request->input('mac')) {
            $mac = $request->input('mac');
            $mac = str_replace(":", "", $mac);
            $product = Product::where('mac_address', '=', $mac)->firstOrFail();
            //var_dump($product);
            if ($product) {
                $proj_id = $product->proj_id;
            }
        } else if ($request->input('id')) {
            $proj_id = $request->input('id');
        }

        $homepage = $this->getUrls($proj_id);
        return json_encode($homepage);
    }

    private function getUrls($id)
    {
         $logo = Logo::where('proj_id', '=', $id)->latest()->get()->first();
         $banner = Banner::where('proj_id', '=', $id)->latest()->get()->first();
         $advertisting1 = Advertisting::where('proj_id', '=', $id)->where('position', '=', '1')->latest()->get()->first();
         $advertisting2 = Advertisting::where('proj_id', '=', $id)->where('position', '=', '2')->latest()->get()->first();
         $video = Video::where('proj_id', '=', $id)->latest()->get()->first();
         $announce = Announce::where('proj_id', '=', $id)->latest()->get()->first();
         $info = Information::where('proj_id', '=', $id)->latest()->get()->first();
         $help = Help::where('proj_id', '=', $id)->latest()->get()->first();
         $more = More::where('proj_id', '=', $id)->latest()->get()->first();

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

