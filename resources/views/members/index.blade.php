@extends('layouts.admin')

@section('content')

<style>

.page-member{
    background:linear-gradient(135deg,#f8f3e8,#ffffff);
    padding:25px;
    border-radius:20px;
    min-height:calc(100vh - 120px);
}

.page-title{
    color:#5d4037;
    font-weight:700;
    font-size:30px;
}

.member-card{
    background:#fff;
    border-radius:20px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.top-action{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
    margin-bottom:20px;
}

.search-box{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.search-box input,
.search-box select{

    border-radius:12px;
    border:2px solid #e7d5b2;
    min-width:220px;
}

.search-box input:focus,
.search-box select:focus{

    border-color:#c59d5f;
    box-shadow:none;

}

.btn-library{

    background:#c59d5f;
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;

}

.btn-library:hover{

    background:#b98b46;
    color:white;

}

.btn-export{

    background:#6d4c41;
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 20px;
    font-weight:600;

}

.btn-export:hover{

    background:#5b3d34;
    color:white;

}

.table{

    border-radius:15px;
    overflow:hidden;

}

.table thead th{

    background:#6d4c41;
    color:white;
    text-align:center;
    vertical-align:middle;

}

.table td{

    text-align:center;
    vertical-align:middle;
    color:#555;

}

.table tbody tr:hover{

    background:#fcf6ec;

}

.status-active{

    background:#eef8ee;
    color:#2e7d32;
    padding:6px 14px;
    border-radius:30px;
    font-weight:600;

}

.status-non{

    background:#ececec;
    color:#666;
    padding:6px 14px;
    border-radius:30px;
    font-weight:600;

}

.btn-action{

    width:38px;
    height:38px;
    border:none;
    border-radius:10px;
    color:white;

}

.btn-edit{

    background:#d6b06b;

}

.btn-delete{

    background:#b85c5c;

}

.pagination{

    justify-content:center;

}

.pagination .page-link{

    color:#6d4c41;

}

.pagination .active .page-link{

    background:#c59d5f;
    border-color:#c59d5f;

}

</style>

<div class="page-member">

<div class="top-action">

<div>

<h3 class="page-title">
👥 Data Anggota
</h3>

</div>

<div>

<a href="{{ route('members.create') }}" class="btn btn-library">

<i class="fas fa-user-plus"></i>

Tambah Anggota

</a>

<a href="{{ route('members.export.pdf') }}" class="btn btn-export">

<i class="fas fa-file-pdf"></i>

Export PDF

</a>

</div>

</div>

<div class="member-card">

<form method="GET" class="search-box mb-4">

<input
type="text"
name="search"
value="{{ request('search') }}"
class="form-control"
placeholder="Cari kode, nama, email...">

<select
name="status"
class="form-select">

<option value="">Semua Status</option>

<option value="Aktif"
{{ request('status')=='Aktif'?'selected':'' }}>
Aktif
</option>

<option value="Nonaktif"
{{ request('status')=='Nonaktif'?'selected':'' }}>
Nonaktif
</option>

</select>

<button class="btn btn-library">

<i class="fas fa-search"></i>

Cari

</button>

</form>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th width="60">No</th>
<th>Kode</th>
<th>Nama</th>
<th>Email</th>
<th>No HP</th>
<th>Status</th>
<th width="140">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($members as $member)

<tr>

<td>

{{ ($members->currentPage()-1)*$members->perPage()+$loop->iteration }}

</td>

<td>

<strong>{{ $member->member_code }}</strong>

</td>

<td>

{{ $member->name }}

</td>

<td>

{{ $member->email }}

</td>

<td>

{{ $member->phone }}

</td>

<td>

@if($member->status=="Aktif")

<span class="status-active">

Aktif

</span>

@else

<span class="status-non">

Nonaktif

</span>

@endif

</td>

<td>

<a
href="{{ route('members.edit',$member->id) }}"
class="btn btn-action btn-edit">

<i class="fas fa-edit"></i>

</a>

<form
action="{{ route('members.destroy',$member->id) }}"
method="POST"
style="display:inline;">

@csrf
@method('DELETE')

<button
class="btn btn-action btn-delete"
onclick="return confirm('Yakin ingin menghapus anggota?')">

<i class="fas fa-trash"></i>

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="7">

Belum ada data anggota.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-4">

{{ $members->links('pagination::bootstrap-5') }}

</div>

</div>

</div>

@endsection