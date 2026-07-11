<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $memberships = Membership::active()->get();
        return view('pages.support', compact('memberships'));
    }
}
