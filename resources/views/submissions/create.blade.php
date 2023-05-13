@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resursi</div>
                    <div class="card-body">
                        <form action="{{url('someurl')}}" method="post">
                        <input type="text" name="someName" />
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
