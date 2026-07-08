<!DOCTYPE html>
<html>
<head>
    <title>Laporan Denda</title>
</head>
<body>

<h2>Laporan Denda Perpustakaan</h2>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Peminjaman</th>
        <th>Hari Terlambat</th>
        <th>Jumlah</th>
        <th>Status</th>
    </tr>

    @foreach($fines as $fine)
    <tr>
        <td>{{ $fine->id }}</td>
        <td>{{ $fine->borrowing_id }}</td>
        <td>{{ $fine->days_late }}</td>
        <td>{{ $fine->amount }}</td>
        <td>{{ $fine->status }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>