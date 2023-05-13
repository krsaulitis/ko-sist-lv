@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <button class="card-header btn " ><a href="{{ route('list-resources') }}" style="text-decoration: none; ">PIEVIENOT RESURSU</a></button>
            </div>
            <br>
        </div>
        <div class="col-md-8">
        <div class="card">
            <div class="card-header">Resursu saraksts</div>
        <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nosaukums</th>
                                <th scope="col">Datums</th>
                            </tr>
                            </thead>
                            @foreach($resources as $resource)
                            <tbody>
                            <tr>
                                <td>{{$resource->name}}</td>
                                <td>{{$resource->updated_at}}</td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>

                    </div>

        </div>
        </div>
        </div>
    </div>
</div>

@endsection
