<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Shared\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventsApiController extends Controller
{
    public function create(EventDataRequest $request): JsonResponse
    {
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->datetime_from = $request->dates['from'];
        $event->datetime_to = $request->dates['to'];

        if (!$event->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to save the event']);
        }

        $event->resources()->sync($request->resources);

        return response()->json(['success' => true, 'data' => $event->toArray()]);
    }

    public function update(string $id, EventDataRequest $request): JsonResponse
    {
        /** @var Event $event */
        $event = Event::query()->find($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->datetime_from = $request->dates['from'];
        $event->datetime_to = $request->dates['to'];

        if (!$event->save()) {
            return response()->json(['success' => false, 'message' => 'Failed to save the event']);
        }

        $event->resources()->sync($request->resources);

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
}
