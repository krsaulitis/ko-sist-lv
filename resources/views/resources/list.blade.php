<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @var string $search
 */
?>
@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="col-12 card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        Resursi
                        <div class="input-group input-group-sm" style="width: 50%;">
                            <span class="input-group-text" id="search-addon"><i class="bi bi-search"></i></span>
                            <input id="search-input" type="text" class="form-control" placeholder="Search"
                                   aria-label="Search"
                                   aria-describedby="search-addon" value="{{ $search }}">
                        </div>
                    </div>
                    <div class="card-body">
                        @if($resources)
                            <table class="table table-striped table-hover align-middle">
                                <thead>
                                <tr>
                                    <th scope="col">Nosaukums</th>
                                    <th scope="col">Datums</th>
                                    <th scope="col">Izmērs</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($resources as $resource)
                                    <tr>
                                        <td>{{ $resource->title }}</td>
                                        <td>{{ Carbon::parse($resource->created_at)->format('d.m.Y') }}</td>
                                        <td>{{ number_format(Storage::size('public/' . $resource->path) / 1024 / 1024, 2) }}
                                            MB
                                        </td>
                                        <td style="width: 120px">
                                            <a href="{{ Storage::url($resource->path) }}" download
                                               class="btn btn-primary">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <button data-id="{{ $resource->id }}" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="d-flex align-items-center justify-content-center mt-3">
                                <p>Resursi nav atrasti</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?= route('resources-create') ?>"
                       class="offset-md-10 col-md-2 btn btn-primary">Pievienot</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-resource').forEach(btn => {
            btn.addEventListener('click', function () {
                let id = this.dataset.id;
                fetch(`/api/resources/${id}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
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

        function search() {
            const search = document.querySelector('#search-input').value;
            document.location.search = search ? '?search=' + search : '';
        }

        document.querySelector('#search-addon').addEventListener('click', search);
        document.querySelector('#search-input').addEventListener('keydown', (e) => {
            if (e.keyCode === 13) {
                search(e);
            }
        });
    </script>
@endsection
