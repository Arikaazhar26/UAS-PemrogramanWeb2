@extends('layouts.admin')

@section('content')

<style>

.page-borrow{
    background:linear-gradient(135deg,#f8f2e7,#ffffff);
    min-height:calc(100vh - 120px);
    padding:25px;
    border-radius:20px;
}

.page-title{
    color:#5d4037;
    font-weight:700;
    font-size:30px;
}

.borrow-card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    padding:25px;
}

.search-box{
    position:relative;
}

.search-box i{
    position:absolute;
    left:15px;
    top:14px;
    color:#9e9e9e;
}

.search-box input{
    padding-left:45px;
    border-radius:12px;
    border:2px solid #ead7b7;
    height:48px;
}

.search-box input:focus{
    border-color:#c79b5d;
    box-shadow:none;
}

.table{
    border-radius:15px;
    overflow:hidden;
}

.table thead th{
    background:#6d4c41;
    color:#fff;
    text-align:center;
    vertical-align:middle;
    font-size:15px;
}

.table tbody td{
    text-align:center;
    vertical-align:middle;
    color:#555;
}

.table-hover tbody tr:hover{
    background:#fdf6eb;
}

.book-image{
    width:55px;
    height:75px;
    object-fit:cover;
    border-radius:8px;
    border:2px solid #d7b06b;
}

.status{
    font-weight:600;
}

.status.borrowed{
    color:#2e7d32;
}

.status.returned{
    color:#1565c0;
}

.status.late{
    color:#d84315;
}

.btn-add{
    background:#c79b5d;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:12px;
    font-weight:600;
}

.btn-add:hover{
    background:#b5894f;
    color:white;
}

.btn-pdf{
    background:#6d4c41;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:12px;
}

.btn-pdf:hover{
    background:#5b3b33;
    color:white;
}

.action-btn{
    width:36px;
    height:36px;
    border:none;
    border-radius:10px;
    color:white;
}

.edit-btn{
    background:#d7a857;
}

.delete-btn{
    background:#c04d4d;
}

.return-btn{
    background:#6a9f5a;
}

.pagination{
    justify-content:center;
}

.pagination .page-link{
    color:#6d4c41;
}

.pagination .active .page-link{
    background:#c79b5d;
    border-color:#c79b5d;
}

</style>

<div class="page-borrow">

    <div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="page-title">
        <i class="fas fa-book-reader"></i>
        Data Peminjaman
    </h2>

    <div>

        <a href="{{ route('borrowings.create') }}" class="btn btn-add">

            <i class="fas fa-plus-circle"></i>

            Tambah Peminjaman

        </a>

        <a href="{{ route('borrowings.export.pdf') }}" class="btn btn-pdf">

            <i class="fas fa-file-pdf"></i>

            Export PDF

        </a>

    </div>

</div>

    <div class="borrow-card">

        <form method="GET" class="mb-4">

<div class="search-box">

<i class="fas fa-search"></i>

<input
type="text"
name="search"
value="{{ request('search') }}"
class="form-control"
placeholder="Cari nama anggota atau judul buku...">

</div>

</form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>

                    <th>No</th>
                    <th>Cover</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($borrowings as $b)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>

                        @if($b->book && $b->book->cover)

                            <img
                                src="{{ asset('covers/'.$b->book->cover) }}"
                                class="book-image">

                        @else

                            <img
                                src="https://via.placeholder.com/60x80"
                                class="book-image">

                        @endif

                    </td>

                    <td>{{ $b->member->name }}</td>

                    <td>{{ $b->book->title }}</td>

                    <td>{{ $b->borrow_date }}</td>

                    <td>{{ $b->return_date }}</td>

                   <td>

@if($b->status=='borrowed')

<span class="status borrowed">
Dipinjam
</span>

@elseif($b->status=='returned')

<span class="status returned">
Dikembalikan
</span>

@else

<span class="status late">
Terlambat
</span>

@endif

</td>

                        <td>

@if($b->status!='returned')

<form action="{{ route('borrowings.return',$b->id) }}"
method="POST"
style="display:inline">

@csrf

<button
class="action-btn return-btn"
title="Kembalikan">

<i class="fas fa-undo"></i>

</button>

</form>

@endif

<a
href="{{ route('borrowings.edit',$b->id) }}"
class="btn action-btn edit-btn"
title="Edit">

<i class="fas fa-edit"></i>

</a>

<form
action="{{ route('borrowings.destroy',$b->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button
class="action-btn delete-btn"
onclick="return confirm('Yakin ingin menghapus?')">

<i class="fas fa-trash"></i>

</button>

</form>

</td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Belum ada data peminjaman.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center">

            {{ $borrowings->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection