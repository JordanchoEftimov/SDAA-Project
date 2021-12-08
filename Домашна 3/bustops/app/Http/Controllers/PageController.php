<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function homepage(): Response
    {
        return Inertia::render('Homepage');
    }

    public function about_us(): Response
    {
        return Inertia::render('AboutUs');
    }
}
