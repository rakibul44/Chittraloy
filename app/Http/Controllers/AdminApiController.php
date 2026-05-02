<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Project;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\Inquiry;
use App\Models\Contact;
use App\Models\Setting;

class AdminApiController extends Controller
{
    // === READ ===
    public function index()
    {
        return response()->json([
            'hero' => Hero::all(),
            'projects' => Project::all(),
            'gallery' => Gallery::orderBy('order')->get(),
            'packages' => Package::all(),
            'testimonials' => Testimonial::all(),
            'inquiries' => Inquiry::orderBy('created_at', 'desc')->get(),
            'contacts' => Contact::orderBy('created_at', 'desc')->get(),
            'settings' => Setting::pluck('value', 'key'),
        ]);
    }

    // === SAVE METHODS ===
    public function saveHero(Request $request)
    {
        $hero = Hero::updateOrCreate(['id' => $request->id], $request->all());
        return response()->json($hero);
    }

    public function saveProject(Request $request)
    {
        $project = Project::updateOrCreate(['id' => $request->id], $request->all());
        return response()->json($project);
    }

    public function saveGallery(Request $request)
    {
        $gallery = Gallery::updateOrCreate(['id' => $request->id], $request->all());
        return response()->json($gallery);
    }

    public function savePackage(Request $request)
    {
        $package = Package::updateOrCreate(['id' => $request->id], $request->all());
        return response()->json($package);
    }

    public function saveTestimonial(Request $request)
    {
        $testimonial = Testimonial::updateOrCreate(['id' => $request->id], $request->all());
        return response()->json($testimonial);
    }

    public function updateInquiryStatus($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $inquiry->status === 'pending' ? 'replied' : 'pending';
        $inquiry->save();
        return response()->json($inquiry);
    }

    public function saveSettings(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return response()->json(['success' => true]);
    }

    // === DELETE ===
    public function deleteItem($model, $id)
    {
        $models = [
            'hero' => Hero::class,
            'projects' => Project::class,
            'gallery' => Gallery::class,
            'packages' => Package::class,
            'testimonials' => Testimonial::class,
            'inquiries' => Inquiry::class,
            'contacts' => Contact::class,
        ];

        if (!array_key_exists($model, $models)) {
            return response()->json(['error' => 'Invalid model'], 400);
        }

        $models[$model]::destroy($id);
        return response()->json(['success' => true]);
    }
}
