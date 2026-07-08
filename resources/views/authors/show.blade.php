@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">

            <h4>📖 Detail Penulis</h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="200">

                        ID

                    </th>

                    <td>

                        {{ $author->id }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Nama Penulis

                    </th>

                    <td>

                        {{ $author->name }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Dibuat

                    </th>

                    <td>

                        {{ $author->created_at }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Diupdate

                    </th>

                    <td>

                        {{ $author->updated_at }}

                    </td>

                </tr>

            </table>

            <a href="{{ route('authors.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection