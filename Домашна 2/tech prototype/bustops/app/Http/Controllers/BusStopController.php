<?php

namespace App\Http\Controllers;

use App\Models\BusStop;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

class BusStopController extends Controller
{
    public function index(Request $request)
    {
        $bus_stops = BusStop::query()->paginate(9);

        if ($request->wantsJson()) return JsonResource::make($bus_stops);

        return Inertia::render('BusStops', compact('bus_stops'));
    }
}
