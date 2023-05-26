@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-4 col-lg-6 col-md-8 col-12">
                <div class="row card">
                    <div class="card-header">Apsveicam!</div>
                    <div class="card-body">
                        <p>E-pasts veiksmīgi apstiprināts! Atliek vien <a href="{{ route('login') }}">pieslēgites</a> un nomainīt noklusējuma paroli.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
@endsection
