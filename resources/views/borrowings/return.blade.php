@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-dark">Pengembalian Buku</h2>
        <p class="text-muted">
            Daftar buku yang sedang dipinjam
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0 fw-bold">
                Daftar Peminjaman
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                    <tr>

                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($borrowings as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->member->name }}</td>

                        <td>{{ $item->book->title }}</td>

                        <td>{{ $item->borrow_date }}</td>

                        <td>{{ $item->due_date }}</td>

                        <td>

                            <span class="badge bg-warning">

                                Sedang Dipinjam

                            </span>

                        </td>

                        <td>

                            @if($item->fine > 0)

                                <span class="text-danger fw-bold">

                                    Rp {{ number_format($item->fine,0,',','.') }}

                                </span>

                            @else

                                -

                            @endif

                        </td>

                        <td>

                            <form action="{{ route('borrow.return',$item->id) }}" method="POST">

                                @csrf

                                <button class="btn btn-success btn-sm">

                                    <i class="bi bi-arrow-return-left"></i>

                                    Kembalikan

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Tidak ada buku yang sedang dipinjam.

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection