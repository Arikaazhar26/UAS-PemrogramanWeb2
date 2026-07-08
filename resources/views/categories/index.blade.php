@extends('layouts.admin')

@section('content')

<style>

.page-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
flex-wrap:wrap;
gap:15px;
}

.page-title{
font-size:30px;
font-weight:700;
color:#4e342e;
margin:0;
}

.page-subtitle{
color:#777;
margin-top:5px;
}

.btn-add{
background:#6d4c41;
color:#fff;
border:none;
padding:10px 18px;
border-radius:10px;
font-weight:600;
}

.btn-add:hover{
background:#4e342e;
color:#fff;
}

.card-custom{
background:#fff;
border:none;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
overflow:hidden;
}

.table thead{
background:#6d4c41;
color:#fff;
}

.table th,
.table td{
vertical-align:middle;
}

.badge-book{
background:#8d6e63;
color:white;
padding:7px 12px;
border-radius:30px;
font-size:12px;
}

.action-btn{
width:35px;
height:35px;
display:inline-flex;
justify-content:center;
align-items:center;
border-radius:8px;
}

.search-box{
background:#fff;
padding:20px;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
margin-bottom:20px;
}

</style>

<div class="container-fluid">

<div class="page-header">

<div>

<h2 class="page-title">

🏷 Data Kategori

</h2>

<p class="page-subtitle">

Kelola kategori buku perpustakaan.

</p>

</div>

<a href="{{ route('categories.create') }}" class="btn btn-add">

<i class="bi bi-plus-circle"></i>

Tambah Kategori

</a>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

{{ session('success') }}

<button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="search-box">

<form method="GET">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="keyword"
class="form-control"
placeholder="Cari kategori..."
value="{{ request('keyword') }}">

</div>

<div class="col-md-2">

<button class="btn btn-dark w-100">

Cari

</button>

</div>

</div>

</form>

</div>

<div class="card-custom">

<div class="table-responsive">

<table class="table table-hover mb-0">

<thead>

<tr>

<th width="70">No</th>

<th>Nama Kategori</th>

<th>Deskripsi</th>

<th width="120">Jumlah Buku</th>

<th width="170">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($categories as $category)

<tr>

<td>

{{ $loop->iteration + ($categories->currentPage()-1) * $categories->perPage() }}

</td>

<td>

<strong>{{ $category->name }}</strong>

</td>

<td>

{{ $category->description ?: '-' }}

</td>

<td>

<span class="badge-book">

{{ $category->books_count }}

Buku

</span>

</td>

<td>

<a
href="{{ route('categories.edit',$category->id) }}"
class="btn btn-warning btn-sm action-btn">

<i class="bi bi-pencil-fill"></i>

</a>

<button
class="btn btn-danger btn-sm action-btn"
data-bs-toggle="modal"
data-bs-target="#delete{{ $category->id }}">

<i class="bi bi-trash-fill"></i>

</button>

</td>

</tr>

<!-- Modal Hapus -->

<div class="modal fade" id="delete{{ $category->id }}" tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header bg-danger text-white">

<h5 class="modal-title">

Hapus Kategori

</h5>

<button
class="btn-close"
data-bs-dismiss="modal">

</button>

</div>

<div class="modal-body">

Yakin ingin menghapus kategori

<b>{{ $category->name }}</b> ?

</div>

<div class="modal-footer">

<button
class="btn btn-secondary"
data-bs-dismiss="modal">

Batal

</button>

<form
action="{{ route('categories.destroy',$category->id) }}"
method="POST">

@csrf
@method('DELETE')

<button class="btn btn-danger">

Ya, Hapus

</button>

</form>

</div>

</div>

</div>

</div>

@empty

<tr>

<td colspan="5" class="text-center py-5">

<i class="bi bi-folder2-open fs-1 text-secondary"></i>

<br><br>

Belum ada data kategori.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<div class="d-flex justify-content-between align-items-center mt-4">

<div class="text-muted">

Total :

<b>{{ $categories->total() }}</b>

Kategori

</div>

<div>

{{ $categories->withQueryString()->links() }}

</div>

</div>

<div class="text-center mt-5">

<hr>

<small class="text-muted">

© {{ date('Y') }} LIBRARIA SYSTEM • Digital Library

</small>

</div>

</div>

@endsection