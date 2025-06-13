<?php

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        return view('frontend.gallery.index');
    }

    public function show(Gallery $gallery)
    {
        return view('frontend.gallery.show', compact('gallery'));
    }
}