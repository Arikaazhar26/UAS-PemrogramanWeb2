@extends('layouts.guest')

@section('content')

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

html,


body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(rgba(40,28,20,.72),rgba(40,28,20,.72)),
    url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1800&q=80');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

}
    background:
    linear-gradient(rgba(40,28,20,.72),rgba(40,28,20,.72)),
    url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1800&q=80');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;



/*==============================*/

.auth-wrapper{

    width:100%;
    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:20px;

}

/*==============================*/
.auth-card{

    width:760px;

    min-height: 470px;

    max-height:90vh;

    background:#fff;

    border-radius:18px;

    overflow:hidden;

    display:flex;

    box-shadow:0 18px 45px rgba(0,0,0,.35);

}

/*==============================*/

.left-side{

    width:38%;

    background:linear-gradient(180deg,#6d4c41,#3e2723);

    color:#fff;

    padding:25px;

    display:flex;
    flex-direction:column;
    justify-content:center;

    position:relative;

}
.right-side{

    width:62%;

    background:#faf8f5;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:20px;

    overflow-y:auto;

}

/*==============================*/

.logo{

    display:flex;
    align-items:center;

    margin-bottom:20px;

}

.logo-circle{

    width:42px;
    height:42px;

    border-radius:10px;

    background:#c59d5f;

    display:flex;
    justify-content:center;
    align-items:center;

    margin-right:12px;

    color:#fff;

    font-size:18px;

}

.logo h2{

    margin:0;

    font-size:20px;

    font-weight:700;

}

.logo span{

    font-size:10px;

    opacity:.85;

}

/*==============================*/

.left-side h1{

    font-size:22px;

    margin-bottom:12px;

    line-height:1.3;

}

.left-side p{

    font-size:12px;

    line-height:20px;

}

.quote{

    margin-top:18px;

    border-left:3px solid #d7b27a;

    padding-left:10px;

    font-size:11px;

    line-height:18px;

    font-style:italic;

}

.book-icon{

    position:absolute;

    right:18px;

    bottom:18px;

    font-size:55px;

    opacity:.08;

}

/*==============================*/

.auth-form{

    width:100%;

    max-width:300px;

    transform:scale(.92);

}
.auth-form h3{

    font-size:22px;

    color:#4e342e;

    margin-bottom:0;

    font-weight:700;

}

.auth-form p{

    font-size:12px;

    color:#777;

    margin-bottom:15px;

}

.form-label{

    font-size:12px;

    font-weight:600;

    color:#4e342e;

}

.mb-3{

    margin-bottom:8px!important;

}

.input-group-text{

    width:42px;

    background:#6d4c41;

    color:white;

    border:none;

}

.form-control{

    height:34px;

    font-size:11px;

}

.form-control:focus{

    box-shadow:none;

    border-color:#6d4c41;

}

.btn-auth{

    width:100%;

    height:42px;

    border:none;

    border-radius:8px;

    background:#6d4c41;

    color:white;

    font-weight:600;

    margin-top:5px;

}

.btn-auth:hover{

    background:#4e342e;

}

.auth-link{

    text-align:center;

    margin-top:8px;

    font-size:12px;

}

.auth-link a{

    text-decoration:none;

    color:#6d4c41;

    font-weight:600;

}

.footer-text{

    text-align:center;

    margin-top:6px;

    font-size:10px;

    color:#888;

}

/*==============================*/

@media(max-width:768px){

.auth-card{

    width:100%;

    height:auto;

    flex-direction:column;

}

.left-side{

    display:none;

}

.right-side{

    width:62%;

    padding:10px 20px;

}

.auth-form{

    max-width:100%;

}



}

</style>

<div class="auth-wrapper">

    <div class="auth-card">

        <!-- ================= LEFT ================= -->

        <div class="left-side">

            <div class="logo">

                <div class="logo-circle">
                    <i class="bi bi-book-half"></i>
                </div>

                <div>
                    <h2>LIBRARIA</h2>
                    <span>Digital Library System</span>
                </div>

            </div>

            <h1>
                Bergabung Bersama
                <br>
                Libraria
            </h1>

            <p>

                Buat akun untuk menikmati layanan
                perpustakaan digital, meminjam buku,
                melihat koleksi terbaru dan mengelola
                aktivitas membaca dengan mudah.

            </p>

            <div class="quote">

                "Membaca hari ini,
                membuka peluang untuk masa depan."

            </div>

            <i class="bi bi-book-half book-icon"></i>

        </div>

        <!-- ================= RIGHT ================= -->

        <div class="right-side">

            <div class="auth-form">

                <h3>Register</h3>

                <p>
                    Lengkapi data berikut untuk membuat akun.
                </p>

                @if ($errors->any())

                    <div class="alert alert-danger py-2">

                        <ul class="mb-0 ps-3">

                            @foreach ($errors->all() as $error)

                                <li style="font-size:12px">
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form method="POST"
                      action="{{ route('register') }}">

                    @csrf

                    <!-- Nama -->

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lengkap
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-person-fill"></i>

                            </span>

                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                required>

                        </div>

                    </div>

                    <!-- Email -->

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-envelope-fill"></i>

                            </span>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email"
                                required>

                        </div>

                    </div>
                                        <!-- Password -->

                    <div class="mb-3">

                        <label class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-lock-fill"></i>

                            </span>

                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                required>

                        </div>

                    </div>

                    <!-- Konfirmasi Password -->

                    <div class="mb-3">

                        <label class="form-label">

                            Konfirmasi Password

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-shield-lock-fill"></i>

                            </span>

                            <input
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                required>

                        </div>

                    </div>

                    <button type="submit" class="btn-auth">

                        <i class="bi bi-person-plus-fill me-2"></i>

                        Daftar Sekarang

                    </button>

                </form>

                <div class="auth-link">

                    Sudah memiliki akun?

                    <a href="{{ route('login') }}">

                        Login Sekarang

                    </a>

                </div>

                <hr>

                <div class="footer-text">

                    © {{ date('Y') }} LIBRARIA SYSTEM

                    <br>

                    Perpustakaan Digital • Universitas Teknologi Bandung

                </div>

            </div>

        </div>

    </div>

</div>

@endsection