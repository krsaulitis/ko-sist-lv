<?php

use App\Models\Event;

/**
 * @var Event $event
 */
?>

@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 col-12">
                <div class="row card">
                    <div class="card-header">{{ $event->title }}</div>
                    <div class="card-body">
                        <p>Sākums: {{$event->datetime_from}}</p>
                        <p>Beigas: {{$event->datetime_to}}</p>
                        <p>{{$event->description}}</p>


                        @if($event->resources->count())
                            <p>Resursi:</p>
                            <ul class="list-group">
                                @foreach ($event->resources as $resource)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="">{{$resource->title}}</span>
                                        <a href="{{ Storage::url($resource->path) }}" download class="btn btn-primary">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="offset-md-8 col-md-2">
                        <a href="<?= route('events-edit', ['id' => $event->id]) ?>"
                           class="btn btn-primary">Labot</a>
                    </div>
                    <div class="col-md-2">
                        <a id="delete" href="javascript:"
                           class="btn btn-danger">Dzēst</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#delete').addEventListener('click', async function () {
            if (!confirm('Vai tiešām vēlies dzēst ierakstu?')) {
                return;
            }

            let data;
            try {
                const response = await fetch("<?= route('api-events-delete', ['id' => $event->id]) ?>", {
                    method: 'DELETE',
                });

                data = await response.json();
            } catch (e) {
                console.error(e);
                return;
            }

            window.location.replace("<?= route('events-list') ?>");
        });
    </script>
@endsection
