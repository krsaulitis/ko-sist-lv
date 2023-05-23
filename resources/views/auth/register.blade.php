@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Reģistrācija</div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="post">
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
                            <label for="surname" class="col-md-4 col-form-label text-md-end text-start">Uzvārds</label>
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
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">E-pasta adrese</label>
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
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end text-start">Telefona numurs</label>
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
                            <label for="former_experience" class="col-md-4 col-form-label text-md-end text-start">Iepriekšējā pieredze</label>
                            <div class="col-md-6">
                                <textarea id="former_experience" name="former_experience" class="form-control">
                                </textarea>
                                @if ($errors->has('former_experience'))
                                    <span class="text-danger">{{ $errors->first('former_experience') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="motivational_letter" class="col-md-4 col-form-label text-md-end text-start">Motivācijas vēstule</label>
                            <div class="col-md-6">
                                <textarea id="motivational_letter" name="motivational_letter" class="form-control">
                                </textarea>
                            </div>
                        </div>
                        @if ($errors->has('motivational_letter'))
                            <span class="text-danger">{{ $errors->first('motivational_letter') }}</span>
                        @endif
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Nosūtīt pieteikumu">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
