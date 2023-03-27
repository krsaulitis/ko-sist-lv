@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kalendārs</div>
                <div class="card-body">
                    Here goes the content
                </div>
            </div>
            @if(true)

            @endif

            @foreach($test as $item)
                <div>{{$item}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection
