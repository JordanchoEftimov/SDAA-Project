<?php

namespace App\Http\Controllers;

use App\Models\BusStop;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class BusStopController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('BusStops');
    }
}
