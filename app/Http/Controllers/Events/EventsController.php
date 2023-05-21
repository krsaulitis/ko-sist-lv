<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Shared\Controller;
use App\Models\Event;
use App\Models\Resource;
use Illuminate\Contracts\Support\Renderable;

class EventsController extends Controller
{
    public function view(string $id): Renderable
    {
        $event = Event::query()->find($id);

        return view('events/view', ['event' => $event]);
    }

    public function list(): Renderable
    {
        $events = Event::query()->get()->all();

        return view('events/list', ['events' => $events]);
    }

    public function create(): Renderable
    {
        return view('events/edit', ['event' => null, 'resources' => $this->getAllResources()]);
    }

    public function edit(string $id): Renderable
    {
        $event = Event::query()->find($id);

        return view('events/edit', ['event' => $event, 'resources' => $this->getAllResources()]);
    }

    /**
     * @return Resource[]
     */
    private function getAllResources(): array
    {
        $resources = [];

        /** @var Resource $resource */
        foreach (Resource::query()->get()->all() as $resource) {
            $resources[$resource->id] = $resource->title;
        }

        return $resources;
    }
}
