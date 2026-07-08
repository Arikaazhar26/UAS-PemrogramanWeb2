@extends('layouts.admin')

@section('content')

<style>

.page-return{
    background:linear-gradient(135deg,#f8f3e8,#ffffff);
    padding:25px;
    border-radius:20px;
    min-height:calc(100vh - 120px);
}

.page-title{
    color:#5d4037;
    font-size:28px;
    font-weight:700;
}

.return-card{
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.search-box{
    width:320px;
}

.search-box .form-control{
    border-radius:12px;
    border:2px solid #d7c4a4;
}

.search-box .form-control:focus{
    border-color:#b48a56;
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
}

.table tbody td{
    text-align:center;
    vertical-align:middle;
}

.table tbody tr:hover{
    background:#fcf8f2;
}

.book-cover{
    width:55px;
    height:75px;
    object-fit:cover;
    border-radius:8px;
    border:2px solid #d8b36a;
}

.status{
    font-weight:600;
    color:#5d4037;
}

.btn-detail{
    background:#c59d5f;
    color:white;
    border:none;
    border-radius:10px;
    padding:6px 12px;
}

.btn-detail:hover{
    background:#b68b4f;
    color:white;
}

.pagination{
    justify-content:center;
}

.pagination .page-link{
    color:#6d4c41;
}

.pagination .active .page-link{
    background:#c59d5f;
    border-color:#c59d5f;
}

</style>

<div class="page-return">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h3 class="page-title">
📚 Data Pengembalian
</h3>
<p class="text-muted mb-0">
Daftar seluruh riwayat pengembalian buku.
</p>
</div>

<form method="GET">

<div class="input-group search-box">

<input
type="text"
name="search"
class="form-control"
value="{{ request('search') }}"
placeholder="Cari anggota atau buku...">

<button class="btn btn-detail">
🔍
</button>

</div>

</form>

</div>

<div class="return-card">

<div class="table-responsive">

<table class="table table-hover table-bordered">

<thead>

<tr>

<th>No</th>
<th>Cover</th>
<th>Anggota</th>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Jatuh Tempo</th>
<th>Tanggal Kembali</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($returns as $return)

<tr>

<td>{{ $loop->iteration }}</td>

<td>

@if($return->book && $return->book->cover)

<img
src="{{ asset('covers/'.$return->book->cover) }}"
class="book-cover">

@else

<img
src="https://via.placeholder.com/55x75"
class="book-cover">

@endif

</td>

<td>{{ $return->member->name ?? '-' }}</td>

<td>{{ $return->book->title ?? '-' }}</td>

<td>{{ $return->borrow_date }}</td>

<td>{{ $return->return_date }}</td>

<td>{{ $return->actual_return_date }}</td>

<td>

@if($return->status=='returned')

<span class="status">
Dikembalikan
</span>

@elseif($return->status=='late')

<span class="status">
Terlambat
</span>

@else

<span class="status">
Dipinjam
</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="8" class="text-center">

Belum ada data pengembalian.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-3">

{{ $returns->links('pagination::bootstrap-5') }}

</div>

</div>

</div>

@endsection