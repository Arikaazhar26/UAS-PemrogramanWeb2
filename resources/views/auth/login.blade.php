<!DOCTYPE html> 
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | Libraria System</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{

margin:0;

padding:0;

box-sizing:border-box;

font-family:'Poppins',sans-serif;

}

body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:
    linear-gradient(rgba(35,25,20,.78),rgba(35,25,20,.78)),
    url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1800&q=80');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;

    overflow:hidden;
}

/* ========================= */

.login-wrapper{
    width:100%;
    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:40px;
}



/* ========================= */

.login-card{
    width:620px;
    max-width:72vw;
    height:350px;

    display:flex;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 20px 45px rgba(0,0,0,.35);
}

/* ========================= */

.left-side{
    width:40%;
    background:linear-gradient(180deg,#5d4037,#3e2723);
    color:#fff;

    display:flex;
    flex-direction:column;
    justify-content:center;

    padding:28px;

    position:relative;
}

.right-side{
    width:60%;
    display:flex;
    justify-content:center;
    align-items:center;

    background:#faf8f5;

    padding:28px;
}

.logo{

display:flex;

align-items:center;

margin-bottom:20px;

}

.logo-circle{
    width:46px;
    height:46px;
    border-radius:12px;
    background:#c59d5f;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:20px;
    margin-right:12px;
}

.logo h2{
    font-size:22px;
}

.logo span{
    font-size:11px;
}

.left-side h1{

font-size:20px;

font-weight:700;

line-height:1.3;

margin:15px 0;

}

.left-side p{

font-size:10px;

line-height:20px;

opacity:.9;

}

.quote{

margin-top:14px;

padding-left:10px;

border-left:3px solid #d7b27a;

font-size:12px;

font-style:italic;

line-height:16px;

}

.book-icon{

position:absolute;

right:14px;

bottom:14px;

font-size:65px;

opacity:.08;

}

/* ========================= */


.login-form{
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.login-form h3{

font-size:20px;

font-weight:700;

color:#4e342e;

margin-bottom:3px;

}

.login-form p{

font-size:10px;

color:#777;

margin-bottom:16px;

}

/* ===========================
FORM
=========================== */

.form-label{

font-size:10px;

font-weight:600;

color:#4e342e;

margin-bottom:4px;

}

.input-group{

margin-bottom:10px;

}

.input-group-text{
    width:42px;
    height:40px;

    background:#6d4c41;
    color:#fff;

    border:none;
    border-radius:8px 0 0 8px;

    display:flex;
    justify-content:center;
    align-items:center;
}

.form-control{
    height:40px;
    font-size:13px;
}


.form-control:focus{

border-color:#8d6e63;

box-shadow:none;

}

/* ===========================
CHECKBOX
=========================== */

.form-check{

margin-top:3px;

}

.form-check-label{

font-size:10px;

color:#666;

}

/* ===========================
BUTTON
=========================== */

.btn-login{
    width:100%;
    height:42px;

    background:#6d4c41;
    color:#fff;

    border:none;

    border-radius:8px;

    font-size:14px;
    font-weight:600;

    transition:.3s;
}

.btn-login:hover{

background:#4e342e;

transform:translateY(-2px);

}

/* ===========================
LINK
=========================== */

.register-link{

margin-top:10px;

text-align:center;

font-size:10px;

}

.register-link a{

text-decoration:none;

color:#6d4c41;

font-weight:700;

}

.register-link a:hover{

text-decoration:underline;

}

.footer-text{

margin-top:10px;

text-align:center;

font-size:8px;

color:#888;

line-height:15px;

}

/* ===========================
RESPONSIVE
=========================== */

@media (max-width:992px){

    .login-card{
    width:760px;
    max-width:80vw;
    height:430px;

    display:flex;

    background:#fff;

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 18px 40px rgba(0,0,0,.35);
}

    .left-side{
    width:38%;
}


    

.login-form h3{
    font-size:25px;
}

.form-control{
    height:40px;
}

.input-group-text{
    height:40px;
}

.btn-login{
    height:42px;
}

</style>

</head>

<body>

<div class="login-wrapper">

<div class="login-card">

<!-- =======================================
LEFT PANEL
======================================= -->

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

Selamat Datang<br>

di Perpustakaan Digital

</h1>



<div class="quote">

"Perpustakaan bukan hanya tempat
menyimpan buku, tetapi tempat
menyimpan masa depan."

</div>

<i class="bi bi-book-half book-icon"></i>

</div>

<!-- =======================================
RIGHT PANEL
======================================= -->

<div class="right-side">

<div class="login-form">

<h3>Login</h3>

<p>Silakan masuk menggunakan akun Anda.</p>

@if(session('status'))

<div class="alert alert-success">

{{ session('status') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

{{ $errors->first() }}

</div>

@endif

<form method="POST" action="{{ route('login') }}">

@csrf

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

name="email"

class="form-control"

placeholder="Masukkan Email"

value="{{ old('email') }}"

required

autofocus>

</div>

</div>

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

name="password"

class="form-control"

placeholder="Masukkan Password"

required>

</div>

</div>

<div class="d-flex justify-content-between align-items-center mb-3">

<div class="form-check">

<input

class="form-check-input"

type="checkbox"

name="remember"

id="remember">

<label

class="form-check-label"

for="remember">

Remember Me

</label>

</div>

@if(Route::has('password.request'))

<a

href="{{ route('password.request') }}"

style="font-size:12px;color:#6d4c41;text-decoration:none;">

Lupa Password?

</a>

@endif

</div>

<button type="submit" class="btn-login">

<i class="bi bi-box-arrow-in-right me-2"></i>

Masuk

</button>

</form>

<div class="register-link">

Belum memiliki akun?

<a href="{{ route('register') }}">

Daftar Sekarang

</a>

</div>

<hr class="my-3">

<div class="footer-text">

© {{ date('Y') }} LIBRARIA SYSTEM

<br>

Perpustakaan Digital • Universitas Teknologi Bandung

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

