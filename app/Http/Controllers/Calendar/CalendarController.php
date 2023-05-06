<?php

namespace App\Http\Controllers\Calendar;
use App\Models\Event;
use App\Http\Controllers\Shared\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(): Renderable
    {
        return view('calendar/view', ['test' => ['a', 'b']]);
    }
    public function getEvent()
    {
    if(request()->ajax())
        	{
        	    $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
                $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
        		$events = Event::whereDate('start', '>=', $start)
                           ->whereDate('end',   '<=', $end)
                           ->get(['id', 'title', 'start', 'end', 'comment']);
                return response()->json($events);
        	}
        return view('calendar/view', ['test' => ['a', 'b']]);
    }

    public function createEvent(Request $request){
            $data = $request->except('_token');
            $events = Event::insert($data);
            return response()->json($events);
        }

        public function deleteEvent(Request $request){
            $event = Event::find($request->id);
            return $event->delete();
        }

    public function edit(): void
    {

    }
    public function getEventList(){
    $events = DatabaseServiceProvider::table('events')->select('title', 'start', 'end', 'comment')->get();
    return view ('calendar-view')->with('events', $events);
    }
}
