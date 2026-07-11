<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        $opportunities = Opportunity::active()->paginate(10);
        return view('pages.opportunities', compact('opportunities'));
    }
}
