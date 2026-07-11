<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function publications(Request $request)
    {
        $search = $request->query('search');
        $query = Download::active()->publications();
        
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        
        $downloads = $query->paginate(10)->withQueryString();
        $type = 'publications';
        return view('pages.downloads', compact('downloads', 'type', 'search'));
    }

    public function reports(Request $request)
    {
        $search = $request->query('search');
        $query = Download::active()->reports();
        
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        
        $downloads = $query->paginate(10)->withQueryString();
        $type = 'reports';
        return view('pages.downloads', compact('downloads', 'type', 'search'));
    }

    public function download(Download $download)
    {
        if (!$download->is_active) {
            abort(404);
        }

        $download->increment('download_count');

        // Check if file is stored locally or a external URL
        if (str_starts_with($download->file_path, 'http://') || str_starts_with($download->file_path, 'https://')) {
            return redirect($download->file_path);
        }

        $fullPath = public_path($download->file_path);
        if ($download->file_path === '#' || empty($download->file_path) || !file_exists($fullPath)) {
            return back()->with('error', 'This document is currently under preparation and will be available for download soon.');
        }

        return response()->download($fullPath);
    }
}
