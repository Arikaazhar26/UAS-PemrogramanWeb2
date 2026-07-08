<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBRARIA</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            min-height:100vh;
            font-family:'Segoe UI',sans-serif;
            background:linear-gradient(to right,#0f172a,#020617,#0f172a);
            color:white;
            overflow-x:hidden;
            font-size:14px;
        }

        /* SIDEBAR */

        .sidebar{
            width:210px;
            height:100vh;
            position:fixed;
            top:0;
            left:0;
            background:rgba(15,23,42,.95);
            padding:15px;
            z-index:1000;
            transition:.3s;
            overflow-y:auto;
        }

        .sidebar.hide{
            left:-210px;
        }

        .logo{
            text-align:center;
            margin-bottom:20px;
        }

        .logo h2{
            color:#e0b15c;
            font-weight:bold;
            margin-top:8px;
            font-size:22px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:10px 12px;
            border-radius:10px;
            margin-bottom:8px;
            transition:.3s;
            font-size:14px;
        }

        .sidebar a:hover{
            background:#d4a24c;
            color:black;
        }

        .sidebar i{
            width:25px;
        }

        /* CONTENT */

        .content{
            margin-left:210px;
            padding:15px;
            transition:.3s;
        }

        .content.full{
            margin-left:0;
        }

        /* TOPBAR */

        .topbar{
            background:rgba(255,255,255,.08);
            border-radius:18px;
            padding:12px 20px;
            margin-bottom:20px;

            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .toggle-btn{
            border:none;
            background:#d4a24c;
            color:white;
            width:42px;
            height:42px;
            border-radius:10px;
            font-size:20px;
        }

        .user-box{
            text-align:right;
        }

        .user-box h4{
            margin:0;
            font-size:16px;
            font-weight:bold;
        }

        .user-box p{
            color:#d4a24c;
            margin:0;
            font-size:12px;
        }

        /* CARD */

        .card{
            background:rgba(255,255,255,.08)!important;
            border:none;
            border-radius:15px;
            color:white;
            backdrop-filter:blur(10px);
        }

        /* TABLE */

        .table{
            font-size:13px;
            color:white;
        }
        .table thead th{
    background:#6d4c41 !important;
    color:#ffffff !important;
    text-align:center;
    vertical-align:middle;
}

.table td{
    color:#333 !important;
    vertical-align:middle;
}

        /* BUTTON */

        .btn{
            font-size:12px !important;
            padding:5px 10px !important;
        }

        /* JUDUL */

        h2{font-size:22px;}
        h3{font-size:20px;}
        h4{font-size:18px;}
        h5{font-size:16px;}

        /* RESPONSIVE */

        @media(max-width:768px){

            .sidebar{
                left:-210px;
            }

            .sidebar.show{
                left:0;
            }

            .content{
                margin-left:0;
            }

        }

    </style>

<style>

body.dark-mode{

    background:#121212 !important;

    color:#f5f5f5;

}

body.dark-mode .card{

    background:#1f1f1f;

    color:white;

}

body.dark-mode .table{

    color:white;

}

body.dark-mode .table thead{

    background:#2d2d2d;

}

body.dark-mode .navbar{

    background:#1c1c1c !important;

}

body.dark-mode .sidebar{

    background:#222 !important;

}

body.dark-mode a{

    color:#ffffff;

}

body.dark-mode input,

body.dark-mode textarea,

body.dark-mode select{

    background:#2c2c2c;

    color:white;

    border:1px solid #555;

}

body.dark-mode .section-card{

    background:#1e1e1e;

}

body.dark-mode .stat-card{

    background:#252525;

}

</style>

</head>
<body>

    <!-- SIDEBAR -->

    <div class="sidebar" id="sidebar">

        <div class="logo">
            <div style="font-size:40px;">📚</div>
            <h2>LIBRARIA</h2>
        </div>

        <a href="{{ route('dashboard') }}">
            <i class="fas fa-gauge"></i> Dashboard
        </a>

        <a href="{{ route('books.index') }}">
            <i class="fas fa-book"></i> Data Buku
        </a>

        <a href="{{ route('members.index') }}">
            <i class="fas fa-users"></i> Anggota
        </a>

        <a href="{{ route('borrowings.index') }}">
            <i class="fas fa-right-left"></i> Peminjaman
        </a>

        <a href="{{ route('returns.index') }}">
            <i class="fas fa-rotate-left"></i> Pengembalian
        </a>

        <a href="{{ route('fines.index') }}">
            <i class="fas fa-money-bill"></i> Denda
        </a>

    </div>

    <!-- CONTENT -->

    <div class="content" id="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <button class="toggle-btn" onclick="toggleSidebar()">
                ☰
            </button>

            <div class="user-box">

                <h4>{{ Auth::user()->name }}</h4>
                <p>Petugas Perpustakaan</p>

                <button
    class="btn btn-outline-secondary me-2"
    id="darkModeToggle">

    🌙 Dark Mode

</button>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="btn btn-danger btn-sm mt-2">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>

                </form>

            </div>

        </div>

        @yield('content')

    </div>

    <!-- SCRIPT -->

    <script>

        function toggleSidebar(){

            document.getElementById('sidebar')
                    .classList.toggle('hide');

            document.getElementById('content')
                    .classList.toggle('full');
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon:'success',
            title:'Berhasil',
            text:'{{ session("success") }}',
            showConfirmButton:false,
            timer:2000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon:'error',
            title:'Gagal',
            text:'{{ session("error") }}'
        });
    </script>
    @endif

    <script>

const btn = document.getElementById('darkModeToggle');

if(localStorage.getItem('theme') === 'dark'){

    document.body.classList.add('dark-mode');

    btn.innerHTML = '☀️ Light Mode';

}

btn.addEventListener('click',function(){

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){

        localStorage.setItem('theme','dark');

        btn.innerHTML='☀️ Light Mode';

    }else{

        localStorage.setItem('theme','light');

        btn.innerHTML='🌙 Dark Mode';

    }

});

</script>

</body>
</html>