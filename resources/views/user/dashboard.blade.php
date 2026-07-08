<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h1>👤 User Dashboard</h1>
    <p>Halo, {{ auth()->user()->name }}</p>

    <div class="card mt-3">
        <div class="card-body">
            <h5>Menu User</h5>
            <ul>
                <li>Lihat Barang</li>
                <li>Beli Produk</li>
                <li>Riwayat Transaksi</li>
            </ul>
        </div>
    </div>

    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
       class="btn btn-danger mt-3">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</div>

</body>
</html>