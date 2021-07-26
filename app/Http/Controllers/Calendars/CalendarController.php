<?php

namespace App\Http\Controllers\Calendars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Calendars\CalendarStoreRequest;

use Carbon\CarbonPeriod;

use App\Models\Calendars\CalendarEvent;

class CalendarController extends Controller
{
    public function store(CalendarStoreRequest $request) {
        $period = CarbonPeriod::create($request->input('date_from'), $request->input('date_to'));
        $vars = $request->only(['name']);

        foreach ($period as $date) {
            if (in_array($date->dayOfWeek, $request->input('day_of_weeks'))) {
                $vars['date'] = $date->format('Y-m-d');
                CalendarEvent::create($vars);
            }
        }

        return response()->json([
            'message' => 'Event(s) successfully saved.'
        ]);
    }

    public function fetch(Request $request) {
        $month = $request->filled('month') ? $request->input('month') : now()->month;
        $year = $request->filled('year') ? $request->input('year') : now()->year;

        $events = CalendarEvent::select(['id', 'name', 'date'])
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        return response()->json([
            'events' => $events
        ]);
    }
}
