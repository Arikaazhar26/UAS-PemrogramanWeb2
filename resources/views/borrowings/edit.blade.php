@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h3 class="fw-bold text-dark">Edit Peminjaman Buku</h3>
        <p class="text-muted">Perbarui data peminjaman dan status pengembalian</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            Form Edit Peminjaman
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- Member -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Member</label>
                        <select name="member_id" class="form-select" required>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ $borrowing->member_id == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->member_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Book -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Buku</label>
                        <select name="book_id" class="form-select" required>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}"
                                    {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} - {{ $book->author }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Pinjam</label>
                        <input type="date"
                               name="borrow_date"
                               class="form-control"
                               value="{{ $borrowing->borrow_date }}"
                               required>
                    </div>

                    <!-- Tanggal Kembali -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Kembali (Estimasi)</label>
                        <input type="date"
                               name="return_date"
                               class="form-control"
                               value="{{ $borrowing->return_date }}"
                               required>
                    </div>

                    <!-- Tanggal Dikembalikan -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Dikembalikan</label>
                        <input type="date"
                               name="actual_return_date"
                               class="form-control"
                               value="{{ $borrowing->actual_return_date }}">
                        <small class="text-muted">Kosongkan jika belum dikembalikan</small>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="borrowed" {{ $borrowing->status == 'borrowed' ? 'selected' : '' }}>
                                Dipinjam
                            </option>
                            <option value="returned" {{ $borrowing->status == 'returned' ? 'selected' : '' }}>
                                Dikembalikan
                            </option>
                        </select>
                    </div>

                    <!-- Denda -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Denda (Rp)</label>
                        <input type="number"
                               name="fine"
                               class="form-control"
                               value="{{ $borrowing->fine ?? 0 }}"
                               min="0">
                        <small class="text-muted">
                            Akan otomatis diisi jika terlambat (bisa juga manual)
                        </small>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-dark">
                        Update Peminjaman
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection