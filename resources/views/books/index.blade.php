
@extends('layouts.admin')

@section('content')


<style>

.page-book{

    background:linear-gradient(
        135deg,
        #f8f1e7,
        #ffffff
    );

    padding:20px;

    border-radius:18px;

    min-height:calc(100vh - 120px);

}


.page-book h3{

    color:#6d4c41;

    font-weight:700;

}



/* CARD */

.book-card{

    background:#ffffff;

    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

}



/* COVER */
.book-image{

    width:60px;

    height:85px;

    object-fit:cover;

    border-radius:8px;

    border:2px solid #d6b06b;

}

.pagination{

    font-size:12px;

}

.page-link{

    padding:4px 10px;

}

/* TABLE */
.table{

    color:#333;

}

.table td{

    color:#333;

}

.table th{

    color:#fff;

    vertical-align:middle;

}

.table-hover tbody tr:hover{

    background:#f8f1e7;

}



/* PAGINATION */

.pagination{

    justify-content:center;

    margin-top:15px;

}



.pagination .page-link{

    color:#6d4c41;

    font-size:12px;

    padding:4px 9px;

}



.pagination .active .page-link{

    background:#c59d5f;

    border-color:#c59d5f;

}



</style>




<div class="page-book">




<div class="d-flex justify-content-between align-items-center mb-3">


   <div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold text-dark m-0 me-3">
        📚 Data Buku
    </h3>

    <div>

        <a href="{{ route('books.export.pdf') }}"
           class="btn btn-danger">

            <i class="bi bi-file-earmark-pdf"></i>
            Export PDF

        </a>

        <a href="{{ route('books.export.excel') }}"
           class="btn btn-success">

            <i class="bi bi-file-earmark-excel"></i>
            Export Excel

        </a>

        <a href="{{ route('books.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Tambah Buku

        </a>

    </div>

</div>

</div>


<div class="book-card mt-3">



<!-- SEARCH -->

<form method="GET" class="mb-3">


<input 
type="text"
name="search"
value="{{ $search ?? '' }}"
class="form-control"
placeholder="Cari judul buku...">


</form>




<table class="table table-bordered table-hover">


<thead>


<tr>

<th>No</th> 

<th>Cover</th>

<th>Judul</th>

<th>Penulis</th>

<th>Penerbit</th>

<th>Tahun</th>

<th>ISBN</th>

<th>Stok</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@forelse($books as $book)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>

        @if($book->cover)

            <img src="{{ asset('covers/'.$book->cover) }}"
                 class="book-image">

        @else

            <img src="https://via.placeholder.com/60x85"
                 class="book-image">

        @endif

    </td>

    <td>{{ $book->title }}</td>
    <td>{{ $book->author }}</td>
    <td>{{ $book->publisher }}</td>
    <td>{{ $book->publish_year }}</td>
    <td>{{ $book->isbn }}</td>
    <td>{{ $book->stock }}</td>

    <td>

        <a href="{{ route('books.edit', $book->id) }}"
           class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('books.destroy', $book->id) }}"
              method="POST"
              style="display:inline;">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin ingin menghapus buku ini?')">

                <i class="fas fa-trash"></i>

            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="9" class="text-center">

        Data buku tidak ditemukan

    </td>

</tr>

@endforelse

</tbody>


</table>




<div class="pagination">


{{ $books->links('pagination::bootstrap-5') }}


</div>



</div>


</div>


@endsection