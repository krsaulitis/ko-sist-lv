<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Shared\Controller;
use App\Models\Event;
use DateTime;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class CalendarController extends Controller
{
    public function index(): Renderable
    {
        $events = Event::query()->get()->all();

        return view('calendar/view', ['events' => $events]);
    }

    public function list(EventListRequest $request): JsonResponse
    {
        $start = $request->start;
        $end = $request->end;

        $events = Event::query()
            ->where('start', '>=', $start)
            ->where('end', '<=', $end)
            ->get()
            ->all();

        return response()->json($events);
    }

    public function create(EventCreateRequest $request): JsonResponse
    {
        $event = new Event();
        $event->title = $request->title;
        $event->comment = "";
        $event->start = (new DateTime())->format(DATE_ATOM);
        $event->end = (new DateTime())->modify('1 minute')->format(DATE_ATOM);

        if (!$event->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to save the event']);
        }

        return response()->json(['success' => true, 'data' => $event->toArray()]);
    }

    public function delete(int $id): JsonResponse
    {
        $event = Event::query()->find($id);

        if (!$event->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete the event']);
        }

        return response()->json(['success' => true]);
    }

    public function update(): void
    {

    }
}
