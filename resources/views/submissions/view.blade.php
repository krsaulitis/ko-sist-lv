@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pieteikumi</div>
                <div class="card-body">
                    @foreach($test as $data)
                        <div class="card m-t-5">
                            <div class="row">
                                <div class="col">{{$data[0]}} {{$data[1]}}</div>
                                <div class="col">E-pasts: {{$data[2]}}</div>
                                <div class="col">Telefona nr: {{$data[3]}}</div>
                            </div>
                            <div>Iepriekšējā pieredze</div>
                            <div>{{$data[4]}}</div>
                            <br>
                            <div>Motivācijas vēstule</div>
                            <div>{{$data[5]}}</div>
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
