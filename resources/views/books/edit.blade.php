@extends('layouts.admin')

@section('content')

<style>

.page-title{
    font-size:28px;
    font-weight:700;
    color:#4e342e;
    margin-bottom:5px;
}

.page-sub{
    color:#777;
    margin-bottom:25px;
}

.form-card{
    background:#fff;
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.card-header-custom{
    background:#6d4c41;
    color:white;
    padding:18px 25px;
    font-size:20px;
    font-weight:bold;
}

.form-label{
    color:#4e342e;
    font-weight:600;
}

.form-control,
.form-select{
    border-radius:12px;
    border:1px solid #ddd;
    padding:10px;
}

.form-control:focus,
.form-select:focus{
    border-color:#8d6e63;
    box-shadow:none;
}

.btn-save{
    background:#6d4c41;
    color:white;
    border:none;
    border-radius:10px;
    padding:10px 25px;
}

.btn-save:hover{
    background:#4e342e;
    color:white;
}

.btn-back{
    border-radius:10px;
    padding:10px 25px;
}

.cover-preview{
    width:180px;
    border-radius:12px;
    border:3px solid #ddd;
}

</style>

<div class="container-fluid">

<div class="mb-4">

<h2 class="page-title">

<i class="bi bi-pencil-square"></i>

Edit Buku

</h2>

<p class="page-sub">

Perbarui data buku perpustakaan

</p>

</div>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

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

<i class="bi bi-book-half me-2"></i>

Form Edit Buku

</div>

<div class="card-body p-4">

<form
action="{{ route('books.update',$book->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Judul Buku

</label>

<input
type="text"
name="title"
class="form-control"
value="{{ old('title',$book->title) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Penulis

</label>

<input
type="text"
name="author"
class="form-control"
value="{{ old('author',$book->author) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Penerbit

</label>

<input
type="text"
name="publisher"
class="form-control"
value="{{ old('publisher',$book->publisher) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Tahun Terbit

</label>

<input
type="number"
name="publish_year"
class="form-control"
value="{{ old('publish_year',$book->publish_year) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

ISBN

</label>

<input
type="text"
name="isbn"
class="form-control"
value="{{ old('isbn',$book->isbn) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Stok

</label>

<input
type="number"
name="stock"
class="form-control"
value="{{ old('stock',$book->stock) }}"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Kategori

</label>

<select
name="category_id"
class="form-select"
required>

@foreach($categories as $category)

<option
value="{{ $category->id }}"
{{ $book->category_id==$category->id ? 'selected' : '' }}>

{{ $category->name }}

</option>

@endforeach

</select>

</div>
<div class="col-md-6 mb-3">

    <label class="form-label">

        Ganti Cover Buku

    </label>

    <input
        type="file"
        name="cover"
        id="cover"
        class="form-control"
        accept="image/*">

    <small class="text-muted">

        Kosongkan jika tidak ingin mengganti cover.

    </small>

</div>

<div class="col-md-12 mb-4 text-center">

    <label class="form-label d-block">

        Cover Saat Ini

    </label>

    @if($book->cover)

        <img

            id="preview"

            src="{{ asset('covers/'.$book->cover) }}"

            class="cover-preview">

    @else

        <img

            id="preview"

            src="https://via.placeholder.com/180x250?text=No+Cover"

            class="cover-preview">

    @endif

</div>

<div class="col-md-12 mb-4">

    <label class="form-label">

        Deskripsi Buku

    </label>

    <textarea

        name="description"

        rows="5"

        class="form-control">{{ old('description',$book->description) }}</textarea>

</div>

</div>

<hr>

<div class="d-flex justify-content-between">

    <a

        href="{{ route('books.index') }}"

        class="btn btn-secondary btn-back">

        <i class="bi bi-arrow-left-circle me-2"></i>

        Kembali

    </a>

    <button

        type="submit"

        class="btn btn-save">

        <i class="bi bi-check-circle-fill me-2"></i>

        Update Buku

    </button>

</div>

</form>

</div>

</div>

</div>
<!-- ===========================
PREVIEW COVER
=========================== -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    const cover = document.getElementById("cover");

    if(cover){

        cover.addEventListener("change", function(e){

            const file = e.target.files[0];

            if(file){

                document.getElementById("preview").src =
                URL.createObjectURL(file);

            }

        });

    }

});

</script>

@endsection