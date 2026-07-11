<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type');
        
        $query = NewsEvent::published();
        
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        
        if ($type && in_array($type, ['news', 'event'])) {
            $query->where('type', $type);
        }
        
        $articles = $query->paginate(9)->withQueryString();
        
        return view('pages.news.index', compact('articles', 'search', 'type'));
    }

    public function show(NewsEvent $newsEvent)
    {
        if (!$newsEvent->is_published || $newsEvent->published_at > now()) {
            abort(404);
        }
        
        $related = NewsEvent::published()
            ->where('id', '!=', $newsEvent->id)
            ->take(3)
            ->get();

        return view('pages.news.show', compact('newsEvent', 'related'));
    }
}
