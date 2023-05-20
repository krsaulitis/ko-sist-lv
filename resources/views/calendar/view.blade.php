@extends('layouts.app')

@section('content')

    <!-- Fullcalendar -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.5/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.5/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.5/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.5/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/moment@6.1.5/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            var btn;
            const calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                timeZone: 'local',
                locale: 'lv',
                firstDay: 1,
                allDaySlot: false,
                navLinks: true,
                editable: true,
                buttonText: {today: 'šodiena', month: 'mēnesis', week: 'nedēļa', day: 'diena', list: 'saraksts'},
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },

                views: {
                    dayGridMonth: {
                        titleFormat: {year: 'numeric', month: 'long'}
                    },
                },
                events: async function (data, onSuccess, onFailure) {
                    const endpoint = '{{ route('list-events') }}?' + new URLSearchParams({
                        start: data.startStr,
                        end: data.endStr,
                    });

                    let response = await fetch(
                        endpoint,
                        {
                            method: "get",
                            headers: {
                                "Content-Type": "application/json",
                            },
                        }
                    );

                    let responseData = await response.json();
                    onSuccess(responseData);
                },
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                // selectable: true,
                //     selectHelper: true,
                    {{--select: async function (start, end, allDay) {--}}
                    {{--    const title = prompt('Notikuma nosaukums:');--}}
                    {{--    if (!title) {--}}
                    {{--        return;--}}
                    {{--    }--}}
                    {{--    let response = await fetch(--}}
                    {{--        "{{ route('create-event') }}",--}}
                    {{--        {--}}
                    {{--            method: "post",--}}
                    {{--            headers: {--}}
                    {{--                "Content-Type": "application/json",--}}
                    {{--            },--}}
                    {{--            body: JSON.stringify({--}}
                    {{--                title: title,--}}
                    {{--                start: start,--}}
                    {{--                end: end,--}}
                    {{--                _token: "{{ csrf_token() }}"--}}
                    {{--            }),--}}
                    {{--        }--}}
                    {{--    );--}}

                    {{--    console.log(await response.json());--}}
                    {{--},--}}


                eventClick: function (event) {
                    const deleteMsg = confirm("Vai tiešām vēlaties izdzēst?");
                    if (!deleteMsg) {
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('delete-event') }}",
                        data: "&id=" + event.id + '&_token=' + "{{ csrf_token() }}",
                        success: function (response) {
                            if (parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                alert("Notikums veiskmīgi izdzēsts");
                            }
                        }
                    });
                }
            });
            calendar.render();
        });
        $(document).on('click', '#modalWindow', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#event_entry_modal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <button class="card-header btn " id="modalWindow">PIEVIENOT NOTIKUMU</button>
                    </div>
                    <div class="card-header">Kalendārs</div>
                    <div>
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                        <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Pievienot jaunu notikumu</h5>

                                    </div>
                                    <div class="modal-body" id="mediumModal">
                                        <div class="img-container">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="event_name">Nosaukums</label>
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter your event name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="start">Sākuma datums</label>
                                                        <input type="date" name="start" id="start" class="form-control onlydatepicker" placeholder="Event start date">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="end">Beigu datums</label>
                                                        <input type="date" name="end" id="end" class="form-control" placeholder="Event end date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-
                                                dismiss="modal"><a href="{{route('calendar-view')}}" style="color: white; text-decoration: none;">Aizvērt</a></button>
                                        <button type="submit" class="btn btn-primary" ><a href="{{route('create-event')}}" style="color: white; text-decoration: none;">Saglabāt</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(true)

                @endif
            </div>
            <div class="col-md-4">
                    <div class="card-body">
                        <div class="card-header">Tuvākie notikumi</div>
                        @php($today = date('Y-m-d H:i:s'))
                        @php($events = \App\Models\Event::where('start', '>', $today)->orderBy('id', 'asc')->take(5)->get())
                        @foreach($events as $event)
                        <div class="card-body">
                            <div>{{$event->title}}</div>
                            <div>{{$event->start}}</div>
                            <div>{{$event->comment}}</div>
                        </div>
                            <hr>
                        @endforeach
                    </div>
            </div>
        </div>
        @brigita.taurina
    </div>
@endsection
