@extends('layouts.admin')

@section('content')

<style>
.page-title{
font-size:28px;
font-weight:700;
color:#4e342e;
}

.page-sub{
color:#777;
margin-bottom:25px;
}

.form-card{
background:#fff;
border:none;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
overflow:hidden;
}

.card-header-custom{
background:#6d4c41;
color:#fff;
padding:18px;
font-size:20px;
font-weight:700;
}

.form-control{
border-radius:10px;
}

.form-control:focus{
border-color:#8d6e63;
box-shadow:none;
}

.btn-save{
background:#6d4c41;
color:white;
border:none;
padding:10px 20px;
border-radius:10px;
}

.btn-save:hover{
background:#4e342e;
color:white;
}
</style>

<div class="container-fluid">

<h2 class="page-title">
➕ Tambah Kategori
</h2>

<p class="page-sub">
Tambahkan kategori baru untuk koleksi buku.
</p>

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<div class="form-card">

<div class="card-header-custom">

Form Tambah Kategori

</div>

<div class="card-body">

<form action="{{ route('categories.store') }}" method="POST">

@csrf

<div class="mb-3">

<label class="form-label">

Nama Kategori

</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>

</div>

<div class="mb-4">

<label class="form-label">

Deskripsi

</label>

<textarea
name="description"
rows="5"
class="form-control">{{ old('description') }}</textarea>

</div>

<div class="text-end">

<a
href="{{ route('categories.index') }}"
class="btn btn-secondary">

Kembali

</a>

<button
class="btn btn-save">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

@endsection