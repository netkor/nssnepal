<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $advisors = TeamMember::active()->byRole('advisor')->get();
        $executives = TeamMember::active()->byRole('executive')->get();
        $staffs = TeamMember::active()->byRole('staff')->get();
        $volunteers = TeamMember::active()->byRole('volunteer')->get();

        return view('pages.team', compact('advisors', 'executives', 'staffs', 'volunteers'));
    }
}
