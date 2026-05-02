<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order')->get()->map(function ($g) {
            return [
                'id' => $g->id,
                'img' => $g->img,
                'cat' => $g->category ?: 'all',
                'title' => $g->title ?: ($g->alt ?: 'Photo'),
                'tag' => $g->tag ?: ($g->category ? ucfirst($g->category) : 'Photo')
            ];
        });

        return view('gallery', compact('galleries'));
    }
}
