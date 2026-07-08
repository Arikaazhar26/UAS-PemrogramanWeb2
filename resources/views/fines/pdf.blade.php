<!DOCTYPE html>
<html>
<head>
    <title>Data Denda</title>
    <style>
        table{
            width:100%;
            border-collapse: collapse;
        }

        th, td{
            border:1px solid black;
            padding:8px;
            text-align:center;
        }
    </style>
</head>
<body>

<h2>Data Denda</h2>

<table>
    <tr>
        <th>No</th>
        <th>Jumlah Denda</th>
        <th>Status</th>
    </tr>

    @foreach($fines as $fine)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>Rp {{ number_format($fine->amount) }}</td>
        <td>{{ $fine->status }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>