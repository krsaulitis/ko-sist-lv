@extends('layouts.app')

@section('body')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events-list') }}">Kalendārs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('resources-list') }}">Resursi</a>
                        </li>
                        @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('submissions-list') }}">Pieteikumi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users-list') }}">Lietotāji</a>
                        </li>
                        @endrole

                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('password-change') }}">
                                        Mainīt paroli
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        Atslēgties
                                    </a>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

@endsection()
