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
                              method="post"
                              action="{{ $event ? route('api-events-update', ['id' => $event->id]) : route('api-events-create') }}">
                            @csrf
                            @method($event ? 'put' : 'post')

                            <div class="col-sm-6">
                                <label class="form-label" for="title">Nosukums</label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="title"
                                       name="title"
                                       value="{{old('title') ?? $event?->title}}">

                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="dates">Laiks</label>
                                <input class="form-control @error('datetime_from') is-invalid @enderror"
                                       name="dates"
                                       value="{{old('date')}}"
                                       id="dates"/>

                                <label>
                                    <input hidden id="datetime_from" name="datetime_from"
                                           value="{{ old('datetime_from') }}">
                                </label>
                                <label>
                                    <input hidden id="datetime_to" name="datetime_to" value="{{ old('datetime_to') }}">
                                </label>

                                @if ($errors->has('datetime_from') || $errors->has('datetime_to'))
                                    <span
                                        class="text-danger">{{ $errors->first('datetime_from') ?? $errors->first('datetime_to') }}</span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="description">Apraksts</label>
                                <textarea type="text"
                                          id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          name="description"
                                          rows="4"
                                          style="min-height: 80px; max-height: 140px">{{old('description') ?? $event?->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="resources">Resursi</label>
                                <select name="resources[]" id="resources"
                                        class="form-control @error('resources') is-invalid @enderror"
                                        multiple>
                                    @foreach($resources as $id => $resource)
                                        @php
                                            $isSelected = in_array($id, old('resources', [])) || $event?->hasResourceById($id);
                                        @endphp
                                        <option value="{{$id}}"
                                            {{$isSelected ? 'selected' : ''}}>
                                            {{$resource}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('resources'))
                                    <span class="text-danger">{{ $errors->first('resources') }}</span>
                                @endif
                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">Saglabāt</button>
                            </div>
                            @if ($errors->has('general'))
                                <span class="text-danger">{{ $errors->first('general') }}</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            const dateFromInput = $('#datetime_from');
            const dateToInput = $('#datetime_to');

            $('#resources').select2();

            $('input[name="dates"]').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                startDate: "{{ $event?->datetime_from ?? date('Y-m-d H:i:s')}}",
                endDate: "{{ $event?->datetime_to ?? date('Y-m-d H:i:s') }}",
                locale: {
                    format: 'Y-MM-D HH:mm'
                },

            });
            const datepicker = $('input[name="dates"]').data('daterangepicker');

            document.querySelector('form')
                .addEventListener('submit', async function (e) {
                    dateFromInput.val(datepicker.startDate.format('Y-MM-D HH:mm:ss'));
                    dateToInput.val(datepicker.endDate.format('Y-MM-D HH:mm:ss'))
                });
        });
    </script>
@endsection

