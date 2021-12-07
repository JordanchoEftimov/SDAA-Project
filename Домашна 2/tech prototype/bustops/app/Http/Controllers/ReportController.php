<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('ReportProblem');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'email' => 'required|email',
            'description' => 'required|min:10'
        ]);

        Report::create($validated);
        return redirect()->back();
    }
}
