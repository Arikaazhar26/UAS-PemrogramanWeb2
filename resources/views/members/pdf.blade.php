<!DOCTYPE html>
<html>
<head>
    <title>Data Member</title>

    <style>

        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th{
            background:#6d4c41;
            color:white;
        }

        th, td{
            padding:8px;
            text-align:center;
        }

        h2{
            text-align:center;
        }

    </style>

</head>
<body>

<h2>DATA MEMBER PERPUSTAKAAN</h2>

<table>

    <thead>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Status</th>
    </tr>
    </thead>

    <tbody>

    @foreach($members as $member)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $member->member_code }}</td>
        <td>{{ $member->name }}</td>
        <td>{{ $member->email }}</td>
        <td>{{ $member->phone }}</td>
        <td>{{ $member->status }}</td>
    </tr>

    @endforeach

    </tbody>

</table>

</body>
</html>