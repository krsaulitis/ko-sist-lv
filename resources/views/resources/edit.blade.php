<?php

use App\Models\Resource;

/**
 * @var Resource $resource
 */
?>
@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Jauns resurss</div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation"
                              method="post"
                              enctype="multipart/form-data"
                              action="{{ $resource ? route('api-resources-update', ['id' => $resource->id]) : route('api-resources-create') }}">
                            @csrf
                            @method($resource ? 'put' : 'post')

                            <div class="col-md-6">
                                <label class="form-label"
                                       for="title">Nosukums</label>
                                <input type="text"
                                       class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') ?? $resource->title }}">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="file">Fails</label>
                                <input id="file"
                                       name="file"
                                       type="file"
                                       class="form-control @error('file') is-invalid @enderror"
                                       accept=".jpg, .png, .pdf" {{ $resource ? '' : 'required' }}>
                                <div class="form-text">Tikai .jpg, .png, .pdf faili ir atļauti.</div>
                                @if ($errors->has('file'))
                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                @endif
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Saglabāt</button>
                            </div>
                            @if ($errors->has('general'))
                                <span class="text-danger">{{ $errors->first('general') }}</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

