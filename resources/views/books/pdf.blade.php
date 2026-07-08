<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Data Buku</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:8px;
            text-align:center;
        }

        table th{
            background:#e5e5e5;
        }

    </style>

</head>

<body>

    <h2>DATA BUKU PERPUSTAKAAN</h2>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>ISBN</th>
                <th>Stok</th>

            </tr>

        </thead>

        <tbody>

        @foreach($books as $book)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $book->title }}</td>

                <td>{{ $book->category->name ?? '-' }}</td>

                <td>{{ $book->author }}</td>

                <td>{{ $book->publisher }}</td>

                <td>{{ $book->publish_year }}</td>

                <td>{{ $book->isbn }}</td>

                <td>{{ $book->stock }}</td>

            </tr>

        @endforeach

        </tbody>

    </table>

</body>

</html>