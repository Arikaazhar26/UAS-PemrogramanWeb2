@extends('layouts.admin')

@section('content')


<style>

.dashboard-page{
    background:linear-gradient(135deg,#f8f3e8,#ffffff);
    min-height:100vh;
    padding:25px;
}


.dashboard-title{
    color:#5d4037;
    font-size:30px;
    font-weight:700;
}


.dashboard-subtitle{
    color:#8d6e63;
    margin-bottom:25px;
}



.stat-card{

    border:none;
    border-radius:20px;
    background:white;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;

}


.stat-card:hover{

    transform:translateY(-6px);

}



.icon-box{

    width:70px;
    height:70px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    background:#f3e5cf;

}



.stat-title{

    color:#8d6e63;
    font-size:15px;

}



.stat-number{

    font-size:28px;
    font-weight:700;
    color:#5d4037;

}




.section-card{

    background:white;
    border-radius:20px;
    box-shadow:0 10px 20px rgba(0,0,0,.08);
    padding:20px;
    margin-top:25px;

}



.section-title{

    color:#5d4037;
    font-weight:700;
    margin-bottom:20px;

}




.table thead th{

    background:#6d4c41;
    color:white;
    text-align:center;

}



.table td{

    text-align:center;
    vertical-align:middle;

}



.table tbody tr:hover{

    background:#fdf8ef;

}




.book-cover{

    width:60px;
    height:80px;
    object-fit:cover;
    border-radius:8px;

}


</style>



<div class="dashboard-page">


<h2 class="dashboard-title">

📚 Dashboard Perpustakaan

</h2>


<p class="dashboard-subtitle">

Selamat datang di Sistem Perpustakaan Digital

</p>




<!-- CARD STATISTIK -->

<div class="row g-4">



<div class="col-lg-3 col-md-6">

<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<div class="stat-title">
Total Buku
</div>


<div class="stat-number">
{{ $totalBooks }}
</div>


</div>


<div class="icon-box">
📚
</div>


</div>


</div>

</div>





<div class="col-lg-3 col-md-6">

<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<div class="stat-title">
Anggota
</div>


<div class="stat-number">
{{ $totalMembers }}
</div>


</div>


<div class="icon-box">
👥
</div>


</div>


</div>


</div>






<div class="col-lg-3 col-md-6">

<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<div class="stat-title">
Sedang Dipinjam
</div>


<div class="stat-number">
{{ $borrowedBooks }}
</div>


</div>


<div class="icon-box">
📖
</div>


</div>


</div>


</div>







<div class="col-lg-3 col-md-6">

<div class="card stat-card">


<div class="card-body d-flex justify-content-between align-items-center">


<div>

<div class="stat-title">
Dikembalikan
</div>


<div class="stat-number">
{{ $returnedBooks }}
</div>


</div>


<div class="icon-box">
🔄
</div>


</div>


</div>


</div>



</div>







<!-- GRAFIK -->

<div class="row mt-4">


<div class="col-md-8">


<div class="section-card">


<h5 class="section-title">

📊 Statistik Perpustakaan

</h5>


<canvas id="statistikChart"></canvas>


</div>


</div>





<div class="col-md-4">


<div class="section-card">


<h5 class="section-title">

📈 Persentase Data

</h5>


<canvas id="pieChart"></canvas>


</div>


</div>



</div>







<!-- DENDA DAN PEMINJAMAN -->

<div class="row">


<div class="col-lg-4">


<div class="section-card">


<h5 class="section-title">

💰 Total Denda

</h5>


<h2 style="color:#5d4037">

Rp {{ number_format($totalFine,0,',','.') }}

</h2>


</div>


</div>





<div class="col-lg-8">


<div class="section-card">


<h5 class="section-title">

📖 Aktivitas Peminjaman Terbaru

</h5>


<div class="table-responsive">


<table class="table table-hover">


<thead>

<tr>

<th>Anggota</th>

<th>Buku</th>

<th>Status</th>

</tr>

</thead>



<tbody>


@foreach($latestBorrowings as $item)


<tr>


<td>

{{ $item->member->name }}

</td>



<td>

{{ $item->book->title }}

</td>



<td>

{{ $item->status }}

</td>


</tr>


@endforeach


</tbody>


</table>


</div>


</div>


</div>


</div>








<!-- BUKU TERBARU -->


<div class="section-card">


<h5 class="section-title">

📚 Buku Terbaru

</h5>



<div class="table-responsive">


<table class="table table-hover">


<thead>


<tr>

<th>Cover</th>

<th>Judul</th>

<th>Penulis</th>

<th>Stok</th>


</tr>


</thead>



<tbody>



@foreach($latestBooks as $book)


<tr>



<td>


@if($book->cover)


<img 
src="{{ asset('covers/'.$book->cover) }}"
class="book-cover">


@else


<img 
src="https://via.placeholder.com/60x80"
class="book-cover">


@endif


</td>




<td>
{{ $book->title }}
</td>



<td>
{{ $book->author }}
</td>



<td>
{{ $book->stock }}
</td>




</tr>


@endforeach



</tbody>



</table>


</div>



</div>






</div>







<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


new Chart(document.getElementById('statistikChart'),{


type:'bar',


data:{


labels:[

'Buku',
'Anggota',
'Dipinjam',
'Dikembalikan'

],


datasets:[{


label:'Jumlah Data',

data:@json($chartData),

borderWidth:2


}]


},


options:{


responsive:true


}



});







new Chart(document.getElementById('pieChart'),{


type:'doughnut',


data:{


labels:[

'Buku',
'Anggota',
'Dipinjam',
'Dikembalikan'

],


datasets:[{


data:@json($chartData),

borderWidth:1


}]


},


options:{


responsive:true


}



});



</script>



@endsection