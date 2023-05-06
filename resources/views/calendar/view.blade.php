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


<script src='fullcalendar/dist/index.global.js'></script>
<script src='fullcalendar/core/locales/lv.global.js'></script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl,{
          themeSystem: 'bootstrap5',
          timeZone: 'local',
          locale: 'lv',
          firstDay: 1,
          allDaySlot: false,
          navLinks: true,
          editable: true,
          buttonText: {today:'šodiena', month: 'mēnesis', week:'nedēļa', day:'diena', list:'saraksts'},
          initialView: 'dayGridMonth',
          headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
              },

          views: {
            dayGridMonth: {
                titleFormat: { year: 'numeric', month: 'long' }
            },
           },
//            events:[{id: '1', title: 'BT', start: '2023-04-26'}]
           events: 'calendar-view',
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
           select: function (start, end, allDay) {
                       var title = prompt('Notikuma nosaukums:');
                       if (title) {
                           var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                           var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
                           $.ajax({
                               url: "{{ URL::to('create-event') }}",
                               data: 'title=' + title + '&start=' + start + '&end=' + end +'&_token=' +"{{ csrf_token() }}",
                               type: "post",
                               success: function (data) {
                                   alert("Notikums veiksmīgi pievienots");
                                   $('#calendar').fullCalendar('refetchEvents');
                               }
                           });
                       }
                   },
                   eventClick: function (event) {
                               var deleteMsg = confirm("Vai tiešām vēlaties izdzēst?");
                               if (deleteMsg) {
                                  $.ajax({
                                       type: "POST",
                                       url: "{{ URL::to('delete-event') }}",
                                       data: "&id=" + event.id+'&_token=' +"{{ csrf_token() }}",
                                       success: function (response) {
                                           if(parseInt(response) > 0) {
                                               $('#calendar').fullCalendar('removeEvents', event.id);
                                               alert("Notikums veiskmīgi izdzēsts");
                                           }
                                       }
                                   });
                               }
                           }
       });
        calendar.render();
      });
</script>
<div  class="container">
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
                    @foreach($test as $data)
                        <div>{{$data}}</div>
                        * * *
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    @brigita.taurina
</div>
@endsection
