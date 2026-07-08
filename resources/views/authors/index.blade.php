@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📖 Data Penulis</h2>

        <a href="{{ route('authors.create') }}" class="btn btn-primary">
            + Tambah Penulis
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="mb-3">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari Penulis..."
                value="{{ request('search') }}">

            <button class="btn btn-dark">
                Cari
            </button>

        </div>

    </form>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">No</th>

                            <th>Nama Penulis</th>

                            <th width="200">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($authors as $author)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $author->name }}</td>

                            <td>

                                <a href="{{ route('authors.show',$author) }}"
                                   class="btn btn-info btn-sm">

                                    Detail

                                </a>

                                <a href="{{ route('authors.edit',$author) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('authors.destroy',$author) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus data?')"
                                        class="btn btn-danger btn-sm">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                Belum ada data penulis.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $authors->links() }}

            </div>

        </div>

    </div>

</div>

@endsection