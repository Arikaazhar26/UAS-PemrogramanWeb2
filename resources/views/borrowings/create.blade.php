@extends('layouts.admin')

@section('content')

<style>

.page-create{
    background:linear-gradient(135deg,#f8f2e7,#ffffff);
    min-height:calc(100vh - 120px);
    padding:25px;
    border-radius:20px;
}

.page-title{
    color:#5d4037;
    font-size:28px;
    font-weight:700;
}

.create-card{

    background:#fff;

    border-radius:20px;

    padding:30px;

    box-shadow:0 12px 25px rgba(0,0,0,.08);

}

.form-label{

    color:#6d4c41;

    font-weight:600;

}

.form-control,
.form-select{

    border-radius:12px;

    border:2px solid #e7d5b5;

    height:48px;

}

.form-control:focus,
.form-select:focus{

    border-color:#c89b5d;

    box-shadow:none;

}

.btn-save{

    background:#c89b5d;

    color:#fff;

    border:none;

    border-radius:12px;

    padding:10px 25px;

    font-weight:600;

}

.btn-save:hover{

    background:#b5894f;

    color:#fff;

}

.btn-back{

    background:#6d4c41;

    color:white;

    border:none;

    border-radius:12px;

    padding:10px 25px;

    font-weight:600;

}

.btn-back:hover{

    background:#5a3b33;

    color:white;

}

</style>

<div class="page-create">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2 class="page-title">

<i class="fas fa-book-reader"></i>

Tambah Peminjaman

</h2>

<a href="{{ route('borrowings.index') }}"
class="btn btn-back">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>

<div class="create-card">

@if ($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('borrowings.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Anggota

</label>

<select
name="member_id"
class="form-select"
required>

<option value="">

-- Pilih Anggota --

</option>

@foreach($members as $member)

<option value="{{ $member->id }}">

{{ $member->member_code }} - {{ $member->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Buku

</label>

<select
name="book_id"
class="form-select"
required>

<option value="">

-- Pilih Buku --

</option>

@foreach($books as $book)

<option value="{{ $book->id }}">

{{ $book->title }}

(Stok : {{ $book->stock }})

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Tanggal Pinjam

</label>

<input
type="date"
name="borrow_date"
class="form-control"
value="{{ date('Y-m-d') }}"
required>

</div>

<div class="col-md-6 mb-4">

<label class="form-label">

Jatuh Tempo

</label>

<input
type="date"
name="return_date"
class="form-control"
value="{{ date('Y-m-d',strtotime('+7 days')) }}"
required>

</div>

</div>

<div class="text-end">

<button
class="btn btn-save">

<i class="fas fa-save"></i>

Simpan Peminjaman

</button>

</div>

</form>

</div>

</div>

@endsection