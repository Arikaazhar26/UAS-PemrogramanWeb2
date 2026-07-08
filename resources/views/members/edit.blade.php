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
    margin-bottom:20px;
}

.member-card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.form-label{
    color:#5d4037;
    font-weight:600;
}

.form-control,
.form-select{

    border-radius:12px;
    border:2px solid #e7d5b2;
    padding:12px;

}

.form-control:focus,
.form-select:focus{

    border-color:#c59d5f;
    box-shadow:0 0 10px rgba(197,157,95,.25);

}

.btn-save{

    background:#c59d5f;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 25px;
    font-weight:600;

}

.btn-save:hover{

    background:#b98b46;
    color:#fff;

}

.btn-back{

    background:#6d4c41;
    color:#fff;
    border:none;
    border-radius:12px;
    padding:10px 25px;
    font-weight:600;

}

.btn-back:hover{

    background:#5b3d34;
    color:#fff;

}

</style>

<div class="page-member">

    <h3 class="page-title">
        ✏ Edit Anggota
    </h3>

    <div class="member-card">

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('members.update',$member->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Kode Anggota
                    </label>

                    <input
                        type="text"
                        name="member_code"
                        class="form-control"
                        value="{{ old('member_code',$member->member_code) }}"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="Aktif"
                        {{ old('status',$member->status)=='Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="Nonaktif"
                        {{ old('status',$member->status)=='Nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$member->name) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$member->email) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone',$member->phone) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        class="form-control">{{ old('address',$member->address) }}</textarea>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit" class="btn btn-save">

                    <i class="fas fa-save"></i>

                    Update

                </button>

                <a href="{{ route('members.index') }}" class="btn btn-back">

                    <i class="fas fa-arrow-left"></i>

                                       Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection