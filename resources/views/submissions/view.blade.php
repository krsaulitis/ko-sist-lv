@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pieteikumi</div>
                <div class="card-body">
                    @foreach($audition_submissions as $submission)
                        <div class="card m-t-5">
                            <div class="row">
                                <div class="col">{{$submission->name}} {{$submission->surname}}</div>
                                <div class="col">E-pasts: {{$submission->email}}</div>
                                <div class="col">Telefona nr: {{$submission->phone_number}}</div>
                            </div>
                            <div>Iepriekšējā pieredze</div>
                            <div>{{$submission->experience}}</div>
                            <br>
                            <div>Motivācijas vēstule</div>
                            <div>{{$submission->motivation}}</div>
                            <div class="row">
                                <a href="#" class="btn">Dzēst</a>
                                <a href="#" class="btn">Apstiprināt</a>
                            </div>
                        </div>
                    @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
