@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
    .container {
        max-width: 500px;
    }
    dl, ol, ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

    <div class="card-header">{{ __('Pievienot resursu') }}</div>
    <div class="card-body">

        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <label for="inputGroupName">Ievadiet nosaukumu</label>
                <input type="text" name="name" class="form-control" id="inputGroupName">
            </div>
            <br>
            <div class="input-group">
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Izvēlieties failu</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Augšupielādēt
            </button>
            </div>
        </form>

    </div>
</div>


            </div>
        </div>
    </div>
@endsection
