@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-8 col-12">
                <div class="card">
                    <div class="card-header">Paroles maiņa</div>
                    <div class="card-body">
                        <form action="{{ route('api-auth-password-change') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="current_password"
                                       class="col-md-4 col-form-label text-md-end text-start">Esošā parole</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password" name="current_password">
                                    @if ($errors->has('current_password'))
                                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end text-start">Jaunā parole</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password_confirmation"
                                       class="col-md-4 col-form-label text-md-end text-start">Jaunā parole</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                           id="password_confirmation" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if ($errors->has('general'))
                                <span class="text-danger">{{ $errors->first('general') }}</span>
                            @endif
                            <div class="mb-3 row justify-content-center offset-md-4 justify-content-md-start ps-md-2">
                                <input type="submit" class="btn btn-primary w-auto"
                                       value="Mainīt">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
