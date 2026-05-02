<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Project;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        $projects = Project::all();
        $galleries = Gallery::orderBy('order')->take(6)->get();
        $packages = Package::all();
        $testimonials = Testimonial::all();

        return view('home', compact('heroes', 'projects', 'galleries', 'packages', 'testimonials'));
    }
}
