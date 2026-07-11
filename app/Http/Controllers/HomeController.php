<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Project;
use App\Models\NewsEvent;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->get();
        
        $featuredProjects = Project::active()->where('is_featured', true)->take(3)->get();
        
        $latestNews = NewsEvent::published()->take(3)->get();
        
        $partners = Partner::active()->get();

        return view('pages.home', compact('sliders', 'featuredProjects', 'latestNews', 'partners'));
    }
}
