<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Download;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $messagesCount = ContactMessage::count();
        $unreadMessagesCount = ContactMessage::unread()->count();
        $projectsCount = Project::count();
        $teamCount = TeamMember::count();
        $downloadsCount = Download::count();

        $latestMessages = ContactMessage::orderByDesc('created_at')->take(5)->get();
        $recentProjects = Project::orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', compact(
            'messagesCount',
            'unreadMessagesCount',
            'projectsCount',
            'teamCount',
            'downloadsCount',
            'latestMessages',
            'recentProjects'
        ));
    }
}
