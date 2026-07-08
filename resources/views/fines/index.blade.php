@extends('layouts.admin')

@section('content')

<style>

.page-fine{
    background:linear-gradient(135deg,#f7f2e9,#ffffff);
    padding:25px;
    border-radius:20px;
    min-height:calc(100vh - 120px);
}

.page-title{
    color:#5d4037;
    font-size:30px;
    font-weight:700;
}

.summary-card{
    background:#fff;
    border-radius:18px;
    padding:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    margin-bottom:25px;
    border-left:6px solid #b48a55;
}

.summary-card h6{
    color:#7b5e3b;
    margin-bottom:8px;
}

.summary-card h2{
    color:#5d4037;
    font-weight:700;
    margin:0;
}

.table-card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    padding:20px;
}

.table{
    margin-bottom:0;
}

.table thead th{
    background:#6d4c41;
    color:#fff;
    text-align:center;
    border:none;
    padding:14px;
}

.table td{
    text-align:center;
    vertical-align:middle;
    color:#555;
    padding:14px;
}

.table tbody tr:hover{
    background:#faf5ef;
}

.btn-export{
    background:#6d4c41;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-export:hover{
    background:#5d4037;
    color:#fff;
}

.btn-excel{
    background:#b48a55;
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-excel:hover{
    background:#9d7442;
    color:white;
}

.badge-status{
    padding:8px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
}

.badge-paid{
    background:#e6f5ea;
    color:#2e7d32;
}

.badge-unpaid{
    background:#fdecea;
    color:#c62828;
}

.pagination{
    justify-content:center;
    margin-top:20px;
}

.pagination .page-link{
    color:#6d4c41;
}

.pagination .active .page-link{
    background:#b48a55;
    border-color:#b48a55;
}

</style>

<div class="page-fine">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="page-title">
            💰 Data Denda
        </h2>

        <div>

            <a href="{{ route('fines.export.pdf') }}" class="btn btn-export">
                <i class="fas fa-file-pdf"></i>
                Export PDF
            </a>

            <a href="{{ route('fines.export.excel') }}" class="btn btn-excel">
                <i class="fas fa-file-excel"></i>
                Export Excel
            </a>

        </div>

    </div>

    <div class="summary-card">

        <h6>Total Denda</h6>

        <h2>
            Rp {{ number_format($totalFines,0,',','.') }}
        </h2>

    </div>

    <div class="table-card">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th width="70">No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Terlambat</th>
                        <th>Jumlah</th>
                        <th>Status</th>

                    </tr>

                </thead>

               <tbody>

@forelse($fines as $fine)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $fine->member->name ?? '-' }}</td>

    <td>{{ $fine->book->title ?? '-' }}</td>

    <td>{{ $fine->days_late }} Hari</td>

    <td>
        <strong>
            Rp {{ number_format($fine->amount,0,',','.') }}
        </strong>
    </td>

    <td>
        @if($fine->status == 'paid')
            <span class="badge-status badge-paid">
                Sudah Dibayar
            </span>
        @else
            <span class="badge-status badge-unpaid">
                Belum Dibayar
            </span>
        @endif
    </td>

</tr>

@empty

<tr>
    <td colspan="6">
        Belum ada data denda.
    </td>
</tr>

@endforelse

</tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center">

            {{ $fines->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection