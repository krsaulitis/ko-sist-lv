<?php

use App\Models\Event;

/**
 * @var Event[] $events
 */
?>

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

@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="row card">
                    <div class="card-header">Kalendārs</div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
                @role('admin')
                <div class="row mt-3 d-flex flex-row justify-content-end gap-3">
                    <a href="<?= route('events-create') ?>"
                       class="btn btn-primary w-auto">Pievienot</a>
                </div>
                @endrole
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                timeZone: 'local',
                locale: 'lv',
                firstDay: 1,
                allDaySlot: false,
                editable: true,
                buttonText: {today: 'šodiena', month: 'mēnesis', week: 'nedēļa', day: 'diena', list: 'saraksts'},
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                views: {
                    dayGridMonth: {
                        titleFormat: {year: 'numeric', month: 'long'}
                    },
                    listMonth: {
                        displayEventTime: true,
                    }
                },
                events: [
                    <?php
                    foreach ($events as $event) {
                        echo json_encode([
                                'id' => $event->id,
                                'title' => $event->title,
                                'start' => $event->datetime_from,
                                'end' => $event->datetime_to,
                            ]) . ",";
                    }
                    ?>
                ],
                eventClick: function (e) {
                    window.location.href = "<?= route('events-view', ['id' => 'id']) ?>".replace('id', e.event.id);
                },
                displayEventTime: false,
                navLinks: true,
            });
            calendar.render();
        });
    </script>
@endsection
