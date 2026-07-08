<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengembalian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4>Tambah Pengembalian Buku</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('returns.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Peminjaman</label>

                    <select name="borrowing_id" class="form-control">

                        @foreach($borrowings as $borrowing)

                            <option value="{{ $borrowing->id }}">
                                Peminjaman #{{ $borrowing->id }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Kembali</label>

                    <input
                        type="date"
                        name="return_date"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">

                    <label>Kondisi Buku</label>

                    <select
                        name="condition"
                        class="form-control">

                        <option>Baik</option>
                        <option>Rusak Ringan</option>
                        <option>Rusak Berat</option>
                        <option>Hilang</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Catatan</label>

                    <textarea
                        name="note"
                        class="form-control"></textarea>

                </div>

                <button class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('returns.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>