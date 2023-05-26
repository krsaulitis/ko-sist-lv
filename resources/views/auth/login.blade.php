@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-4 col-lg-6 col-md-8 col-12">
                <div class="row card">
                    <div class="card-header">Mainīt paroli</div>
                    <div class="card-body">
                        <form action="{{ route('api-auth-login') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end text-start">E-pasts
                                    Address</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end text-start">Parole</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if ($errors->has('general'))
                                <span class="text-danger">{{ $errors->first('general') }}</span>
                            @endif
                            <div class="mb-3 row justify-content-center offset-md-4 justify-content-md-start ps-md-2">
                                <input type="submit" class="btn btn-primary w-auto"
                                       value="Pieslēgties">
                            </div>
                            <div class="mb-3 row text-center text-md-start offset-md-4 ps-md-2">
                                <p class="p-0 m-0">Vēlies dziedāt?
                                    <a href="{{ route('register') }}">Pievienojies</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
