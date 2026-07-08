@extends('layouts.admin')

@section('content')

<style>

.page-title{
font-size:30px;
font-weight:700;
color:#4e342e;
margin-bottom:5px;
}

.page-sub{
color:#777;
margin-bottom:30px;
}

.detail-card{
background:#fff;
border:none;
border-radius:20px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
overflow:hidden;
}

.card-header-custom{
background:#6d4c41;
color:#fff;
padding:18px 25px;
font-size:20px;
font-weight:700;
}

.cover-book{
width:260px;
height:360px;
object-fit:cover;
border-radius:15px;
border:4px solid #eee;
box-shadow:0 8px 20px rgba(0,0,0,.15);
}

.info-table tr td{
padding:13px;
vertical-align:top;
}

.info-table td:first-child{
width:190px;
font-weight:600;
color:#4e342e;
}

.description-box{
background:#fafafa;
border-left:5px solid #6d4c41;
padding:18px;
border-radius:10px;
line-height:1.8;
}

.btn-back{
background:#757575;
color:white;
border:none;
padding:10px 20px;
border-radius:10px;
}

.btn-back:hover{
background:#616161;
color:white;
}

.btn-edit{
background:#6d4c41;
color:white;
border:none;
padding:10px 20px;
border-radius:10px;
}

.btn-edit:hover{
background:#4e342e;
color:white;
}

.badge-stock{
padding:8px 14px;
font-size:13px;
border-radius:30px;
}

.badge-category{
background:#8d6e63;
color:white;
padding:8px 14px;
border-radius:30px;
font-size:13px;
}

</style>

<div class="container-fluid">

<div class="mb-4">

<h2 class="page-title">

📖 Detail Buku

</h2>

<p class="page-sub">

Informasi lengkap mengenai buku perpustakaan.

</p>

</div>

<div class="detail-card">

<div class="card-header-custom">

<i class="bi bi-book-half me-2"></i>

Detail Buku

</div>

<div class="card-body p-4">

<div class="row">

<div class="col-lg-4 text-center">

@if($book->cover)

<img
src="{{ asset('covers/'.$book->cover) }}"
class="cover-book">

@else

<img
src="https://via.placeholder.com/260x360?text=No+Cover"
class="cover-book">

@endif

</div>

<div class="col-lg-8">

<table class="table info-table">

<tr>

<td>Judul Buku</td>

<td>

<strong>

{{ $book->title }}

</strong>

</td>

</tr>

<tr>

<td>Penulis</td>

<td>

{{ $book->author }}

</td>

</tr>

<tr>

<td>Penerbit</td>

<td>

{{ $book->publisher }}

</td>

</tr>

<tr>

<td>Tahun Terbit</td>

<td>

{{ $book->publish_year }}

</td>

</tr>

<tr>

<td>ISBN</td>

<td>

{{ $book->isbn }}

</td>

</tr>

<tr>

<td>Kategori</td>

<td>

<span class="badge-category">

{{ $book->category->name ?? '-' }}

</span>

</td>

</tr>

<tr>

<td>Stok Buku</td>

<td>

@if($book->stock>10)

<span class="badge bg-success badge-stock">

{{ $book->stock }} Buku

</span>

@elseif($book->stock>0)

<span class="badge bg-warning text-dark badge-stock">

{{ $book->stock }} Buku

</span>

@else

<span class="badge bg-danger badge-stock">

Stok Habis

</span>

@endif

</td>

</tr>

</table>

<h5 class="mt-4 mb-3 fw-bold">

Deskripsi Buku

</h5>

<div class="description-box">

@if($book->description)

{{ $book->description }}

@else

<span class="text-muted">

Belum ada deskripsi buku.

</span>

@endif

</div>

<div class="mt-4">

<a
href="{{ route('books.index') }}"
class="btn btn-back">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

<a
href="{{ route('books.edit',$book->id) }}"
class="btn btn-edit">

<i class="bi bi-pencil-square"></i>

Edit Buku

</a>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection