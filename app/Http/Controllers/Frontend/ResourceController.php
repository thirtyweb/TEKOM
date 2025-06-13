<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        return view('frontend.resources.index');
    }

    public function download(Resource $resource)
    {
        $resource->incrementDownloadCount();
        
        if ($resource->download_url) {
            return redirect($resource->download_url);
        }
        
        if ($resource->file_path) {
            return response()->download(storage_path('app/public/' . $resource->file_path));
        }
        
        return back()->with('error', 'File tidak ditemukan.');
    }
}

