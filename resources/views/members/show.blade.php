<!DOCTYPE html>
<html>
<head>
    <title>Detail Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header">
            Detail Anggota
        </div>

        <div class="card-body">

            <h4>{{ $member->name }}</h4>

            <p><b>Kode :</b> {{ $member->member_code }}</p>
            <p><b>Gender :</b> {{ $member->gender }}</p>
            <p><b>Telepon :</b> {{ $member->phone }}</p>
            <p><b>Email :</b> {{ $member->email }}</p>
            <p><b>Alamat :</b> {{ $member->address }}</p>
            <p><b>Status :</b> {{ $member->status }}</p>

            @if($member->photo)
                <img src="{{ asset('storage/'.$member->photo) }}"
                     width="150">
            @endif

            <br><br>

            <a href="{{ route('members.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

</body>
</html>