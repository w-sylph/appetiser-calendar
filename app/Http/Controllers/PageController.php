<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;

class PageController extends Controller
{
    /**
     * Display index page
     *
     */
    public function index() {
        return view('pages.index');
    }

    /**
     * Get API routes
     *
     */
    public function getRoutes() {
        $routes = [
            'calendars.store' => route('calendars.store'),
            'calendars.fetch' => route('calendars.fetch'),
        ];

        return response()->json([
            'routes' => $routes
        ]);
    }
}
