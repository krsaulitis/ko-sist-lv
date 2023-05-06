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
//            events:[{id: '1', title: 'BT', start: '2023-04-26'}]
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
                selectable: true,
                selectHelper: true,
                select: async function (start, end, allDay) {
                    const title = prompt('Notikuma nosaukums:');
                    if (!title) {
                        return;
                    }

                    // start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                    // end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');

                    let response = await fetch(
                        "{{ route('create-event') }}",
                        {
                            method: "post",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                title: title,
                                start: start,
                                end: end,
                                _token: "{{ csrf_token() }}"
                            }),
                        }
                    );

                    console.log(await response.json());
                },
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
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kalendārs</div>
                    <div>
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>

                @if(true)

                @endif
            </div>
            <div class="col-md-4">
                <div>
                    <div class="card-body">
                        @foreach($events as $event)
                            <div>{{$event}}</div>
                            * * *
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        @brigita.taurina
    </div>
@endsection
