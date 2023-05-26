<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Shared\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class EventsApiController extends Controller
{
    public function create(EventDataRequest $request): RedirectResponse
    {
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->datetime_from = $request->datetime_from;
        $event->datetime_to = $request->datetime_to;

        if (!$event->save()) {
            return back()->withErrors(['general' => 'Kaut kas nogāja greizi. Lūdzu mēģini vēlāk.']);
        }

        $event->resources()->sync($request->resources);

        return redirect()->route('events-view', ['id' => $event->id]);
    }

    public function update(string $id, EventDataRequest $request): RedirectResponse
    {
        /** @var Event $event */
        $event = Event::query()->find($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->datetime_from = $request->datetime_from;
        $event->datetime_to = $request->datetime_to;

        if (!$event->save()) {
            return back()->withErrors(['general' => 'Kaut kas nogāja greizi. Lūdzu mēģini vēlāk.']);
        }

        $event->resources()->sync($request->resources);

        return redirect()->route('events-view', ['id' => $event->id]);
    }

    public function delete(int $id): JsonResponse
    {
        $event = Event::query()->find($id);

        if (!$event->delete()) {
            return response()->json(['success' => false, 'message' => 'Failed to delete the event']);
        }

        return response()->json(['success' => true]);
    }
}
