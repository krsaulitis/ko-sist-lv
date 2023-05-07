@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pievienot resursu</div>
                <div class="card-body">
                <form method="POST" action="{{ route('file.upload') }}" aria-label="{{ __('Upload') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Nosaukums') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus />
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="overview" class="col-sm-4 col-form-label text-md-right">{{ __('Augšupielādē failu') }}</label>
                            <div class="col-md-6">
                                <input type="file" id="myfile" name="myfile"><br><br>
                                @if ($errors->has('file_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Augšupielādēt') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        <div class="card">

        <div class="card-body">
                        @foreach($resources as $resource)
                        <div>
                            <div>{{$resource->name}}</div>
                            <div>{{$resources->file_path}}</div>
                        </div>
                            <hr>
                        @endforeach
                    </div>

        </div>
        </div>
        </div>
    </div>
</div>

@endsection
