<?php

use App\Models\AuditionSubmission;

/**
 * @var AuditionSubmission[] $submissions
 */
?>
@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="col-12 card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Pieteikumi
                    </div>
                    <div class="card-body">
                        @if($submissions)
                            @foreach($submissions as $submission)
                                <div class="card">
                                    <div class="card-header">
                                        {{ $submission->fullName() }}
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <p>
                                                E-pasts:
                                                <a href="mailto:{{$submission->email}}">
                                                    {{$submission->email}}
                                                </a>
                                            </p>
                                            <p>
                                                Telefona nr:
                                                <a href="tel:{{$submission->phone_number}}">
                                                    {{ $submission->phone_number }}
                                                </a>
                                            </p>
                                            <p>
                                                Motivācijas vēstule: {{ $submission->motivation }}
                                            </p>
                                            <p>
                                                Iepriekšējā pieredze: {{ $submission->experience }}
                                            </p>
                                        </div>
                                        <div class="d-flex flex-row gap-3">
                                            <button class="btn btn-outline-danger reject-submission w-auto"
                                                    data-id="{{$submission->id}}">Noraidīt
                                            </button>
                                            <button class="btn btn-primary approve-submission w-auto"
                                                    data-id="{{$submission->id}}">Apstiprināt
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex align-items-center justify-content-center mt-3">
                                <p>Nav neapstrādātu pieteikumu</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.approve-submission').forEach(btn => {
            btn.addEventListener('click', function () {
                let id = this.dataset.id;
                fetch("{{ route('api-submissions-approve', ['id' => '_id_']) }}".replace('_id_', id), {
                    method: 'post',
                    headers: {'x-csrf-token': "{{ csrf_token() }}"},
                    credentials: "same-origin",
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to approve submission');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.reject-submission').forEach(btn => {
            btn.addEventListener('click', function () {
                if (!confirm('Vai tiešām vēlies noraidīt pieteikumu?')) {
                    return;
                }

                let id = this.dataset.id;
                fetch("{{ route('api-submissions-reject', ['id' => '_id_']) }}".replace('_id_', id), {
                    method: 'post',
                    headers: {'x-csrf-token': "{{ csrf_token() }}"},
                    credentials: "same-origin",
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to reject submission');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
