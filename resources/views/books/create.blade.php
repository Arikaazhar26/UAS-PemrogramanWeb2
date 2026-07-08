@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">📚 Tambah Buku</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('books.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <input
            type="text"
            name="title"
            class="form-control mb-3"
            placeholder="Judul Buku"
            required>

        <input
            type="text"
            name="author"
            class="form-control mb-3"
            placeholder="Penulis"
            required>

        <input
            type="text"
            name="publisher"
            class="form-control mb-3"
            placeholder="Penerbit"
            required>

        <input
            type="number"
            name="publish_year"
            class="form-control mb-3"
            placeholder="Tahun Terbit"
            required>

        <input
            type="text"
            name="isbn"
            class="form-control mb-3"
            placeholder="ISBN"
            required>

        <input
            type="number"
            name="stock"
            class="form-control mb-3"
            placeholder="Stok Buku"
            required>

        <select
            name="category_id"
            class="form-control mb-3"
            required>

            <option value="">-- Pilih Kategori --</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

        <label class="form-label">
            Cover Buku
        </label>

        <input
            type="file"
            name="cover"
            class="form-control mb-4"
            accept=".jpg,.jpeg,.png,.webp">

        <button type="submit" class="btn btn-primary">
            💾 Simpan Buku
        </button>

        <a href="{{ route('books.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection