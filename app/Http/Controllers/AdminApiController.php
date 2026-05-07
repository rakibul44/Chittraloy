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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        $data = $request->only(['tag', 'title', 'subtitle', 'btn1', 'btn2']);
        
        if ($request->hasFile('bg_file')) {
            $file = $request->file('bg_file');
            $filename = Str::random(20) . '.webp';
            $path = 'hero/' . $filename;
            
            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                
                // Resize to HD width if larger
                if ($image->width() > 1920) {
                    $image->scale(width: 1920);
                }
                
                $encoded = $image->toWebp(80);
                Storage::disk('public')->put($path, (string) $encoded);
                
                $data['bg'] = asset('storage/' . $path);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Image processing failed: ' . $e->getMessage()], 500);
            }
        } else {
            $data['bg'] = $request->bg_url;
        }

        $hero = Hero::updateOrCreate(['id' => $request->id], $data);
        return response()->json($hero);
    }

    public function saveProject(Request $request)
    {
        $data = $request->only(['couple', 'location', 'season', 'img', 'size']);
        $project = Project::updateOrCreate(['id' => $request->id], $data);
        return response()->json($project);
    }

    public function saveGallery(Request $request)
    {
        $data = $request->only(['img', 'alt', 'title', 'category', 'tag', 'order']);
        $gallery = Gallery::updateOrCreate(['id' => $request->id], $data);
        return response()->json($gallery);
    }

    public function savePackage(Request $request)
    {
        $data = $request->only(['name', 'price', 'features', 'featured', 'badge']);
        $data['featured'] = filter_var($data['featured'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $package = Package::updateOrCreate(['id' => $request->id], $data);
        return response()->json($package);
    }

    public function saveTestimonial(Request $request)
    {
        $data = $request->only(['couple', 'location', 'rating', 'quote']);
        $testimonial = Testimonial::updateOrCreate(['id' => $request->id], $data);
        return response()->json($testimonial);
    }

    public function updateInquiryStatus($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->status = $inquiry->status === 'pending' ? 'replied' : 'pending';
        $inquiry->save();
        return response()->json($inquiry);
    }

    public function updateContactStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = $contact->status === 'pending' ? 'replied' : 'pending';
        $contact->save();
        return response()->json($contact);
    }

    public function saveSettings(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if ($key === '_token') continue;
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }
        return response()->json(['success' => true]);
    }

    // === PUBLIC FORM SUBMISSIONS ===
    public function storeInquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $inquiry = Inquiry::create([
            'name' => $request->name,
            'partner' => $request->partner ?? '',
            'email' => $request->email,
            'phone' => $request->phone ?? '',
            'date' => $request->date ?? null,
            'package' => $request->package ?? '',
            'venue' => $request->venue ?? '',
            'message' => $request->message ?? '',
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'inquiry' => $inquiry]);
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'contact' => $contact]);
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

        $item = $models[$model]::find($id);
        if ($item) {
            // Delete associated files if any
            if ($model === 'hero' && $item->bg) {
                $relPath = str_replace(asset('storage/'), '', $item->bg);
                if (Storage::disk('public')->exists($relPath)) {
                    Storage::disk('public')->delete($relPath);
                }
            }
            // Add similar logic for projects/gallery if they use local storage
            
            $item->delete();
        }

        return response()->json(['success' => true]);
    }
}
