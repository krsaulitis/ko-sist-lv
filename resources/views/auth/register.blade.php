@extends('layouts.app')

@section('body')

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6 col-lg-8 col-md-10 col-12">
                <div class="card">
                    <div class="card-header">Pieteikuma izveide</div>
                    <div class="card-body">
                        <form action="{{ route('api-auth-register') }}" method="post">
                            @csrf

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Vārds</label>
                                <div class="col-md-6">
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name"
                                        value="{{ old('name') }}"
                                    >
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="surname"
                                       class="col-md-4 col-form-label text-md-end text-start">Uzvārds</label>
                                <div class="col-md-6">
                                    <input
                                        type="text"
                                        class="form-control @error('surname') is-invalid @enderror"
                                        id="surname" name="surname"
                                        value="{{ old('surname') }}"
                                    >
                                    @if ($errors->has('surname'))
                                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end text-start">E-pasta
                                    adrese</label>
                                <div class="col-md-6">
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email"
                                        value="{{ old('email') }}"
                                    >
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-end text-start">Telefona
                                    numurs</label>
                                <div class="col-md-6">
                                    <input
                                        type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number"
                                        name="phone_number"
                                        value="{{ old('phone_number') }}"
                                    >
                                    @if ($errors->has('phone_number'))
                                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="experience" class="col-md-4 col-form-label text-md-end text-start">Iepriekšējā
                                    pieredze</label>
                                <div class="col-md-6">
                                    <textarea id="experience" name="experience"
                                              class="form-control @error('experience') is-invalid @enderror">{{ old('experience') }}</textarea>
                                    @if ($errors->has('experience'))
                                        <span class="text-danger">{{ $errors->first('experience') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="motivation" class="col-md-4 col-form-label text-md-end text-start">Motivācijas
                                    vēstule</label>
                                <div class="col-md-6">
                                    <textarea id="motivation" name="motivation"
                                              class="form-control @error('motivation') is-invalid @enderror">{{ old('motivation') }}</textarea>
                                    @if ($errors->has('motivation'))
                                        <span class="text-danger">{{ $errors->first('motivation') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 offset-md-4 d-flex flex-row gap-3 ps-md-2">
                                <input type="submit" class="btn btn-primary w-auto col-md-auto col"
                                       value="Nosūtīt pieteikumu">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary w-auto col-md-auto col">Atpakaļ</a>
                            </div>
                            @if ($errors->has('general'))
                                <span class="text-danger">{{ $errors->first('general') }}</span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
