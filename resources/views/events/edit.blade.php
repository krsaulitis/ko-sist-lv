<?php

use App\Models\Event;

/**
 * @var Event|null $event
 */
?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-12">
                <div class="row card">
                    <div class="card-header">{{$event?->title ?? 'Jauns notikums'}}</div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation"
                              action="{{ $event ? route('api-events-update', ['id' => $event->id]) : route('api-events-create') }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="col-sm-6">
                                <label class="form-label" for="title">Nosukums</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{$event?->title}}">
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="dates">Laiks</label>
                                <input class="form-control" name="dates" id="dates"/>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="description">Apraksts</label>
                                <textarea type="text"
                                          id="description"
                                          class="form-control"
                                          name="description"
                                          rows="4"
                                          style="min-height: 80px; max-height: 140px">{{$event?->description}}</textarea>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="resources">Resursi</label>
                                <select name="resources" id="resources" class="form-select" multiple>
                                    @foreach($resources as $id => $resource)
                                        <option value="{{$id}}"
                                            {{$event?->hasResourceById($id) ? 'selected' : ''}}>
                                            {{$resource}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">Saglabāt</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#resources').select2();

            $('input[name="dates"]').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                startDate: "{{ $event?->datetime_from ?? date('Y-m-d H:i:s')}}",
                endDate: "{{ $event?->datetime_to ?? date('Y-m-d H:i:s') }}",
                locale: {
                    format: 'Y-MM-D HH:mm'
                }
            });
            const datepicker = $('input[name="dates"]').data('daterangepicker');

            document.querySelector('form')
                .addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const form = e.target;
                    const formData = new FormData(form);

                    let response;

                    try {
                        const request = {
                            title: formData.get('title'),
                            description: formData.get('description'),
                            dates: {
                                from: datepicker.startDate.format('Y-MM-D HH:mm:ss'),
                                to: datepicker.endDate.format('Y-MM-D HH:mm:ss'),
                            },
                            resources: $('#resources').select2('data').map((option) => option.id),
                        };
                        const rawResponse = await fetch(form.action, {
                            method: "{{ $event ? 'PUT' : 'POST' }}",
                            body: JSON.stringify(request),
                            headers: {"content-type": "application/json",},
                        });

                        response = await rawResponse.json();
                    } catch (e) {
                        console.error(e);
                        // todo: display error
                        return;
                    }

                    if (!response.success) {
                        // todo: display error
                        console.error(response.message);
                    }

                    console.log(response);
                    window.location.href = "<?= route('events-view', ['id' => 'id']) ?>".replace('id', response.data.id);
                });
        });

    </script>
@endsection

