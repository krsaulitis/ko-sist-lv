<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @var User[] $users
 */


?>
@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="col-12 card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Lietotāji
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-hover align-middle">
                            <thead>
                            <tr>
                                <th scope="col">Vārds</th>
                                <th scope="col">Loma</th>
                                <th scope="col">E-pasts</th>
                                <th scope="col">Telefona nr.</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->displayRole() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td style="width: 120px">
                                        @if(Auth::id() !== $user->id)
                                            <button data-id="{{ $user->id }}"
                                                    class="btn btn-danger delete-action">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-action').forEach(btn => {
            btn.addEventListener('click', function () {
                if (!confirm('Vai tiešām vēlaties dzēst lietotāju?')) {
                    return;
                }

                let id = this.dataset.id;
                fetch("{{ route('api-users-delete', ['id' => 'id']) }}".replace('id', id), {
                    method: 'delete',
                    headers: {'x-csrf-token': "{{ csrf_token() }}"},
                    credentials: "same-origin",
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to delete resource');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
