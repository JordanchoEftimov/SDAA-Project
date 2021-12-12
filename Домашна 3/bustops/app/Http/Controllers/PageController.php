<?php

namespace App\Http\Controllers;

use App\Models\BusStop;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function homepage(): Response
    {
        $bus_stops_count = BusStop::query()->count();
        return Inertia::render('Homepage', compact('bus_stops_count'));
    }

    public function about_us(): Response
    {
        return Inertia::render('AboutUs');
    }
}
