<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>

    <style>
        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
            text-align:center;
        }

        th{
            background:#6d4c41;
            color:white;
        }
    </style>
</head>
<body>

<h2 align="center">
    Laporan Data Peminjaman Buku
</h2>

<table>

    <tr>
        <th>No</th>
        <th>Member</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Batas Kembali</th>
        <th>Status</th>
    </tr>

    @foreach($borrowings as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->member->name }}</td>
        <td>{{ $item->book->title }}</td>
        <td>{{ $item->borrow_date }}</td>
        <td>{{ $item->return_date }}</td>
        <td>{{ $item->status }}</td>
    </tr>

    @endforeach

</table>

</body>
</html>