@extends('layouts.main')
@section('title', "Aplikasi Arsip Surat Kelurahan XYZ")
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-body border-0 shadow">
            <h3>Arsip Surat</h3>
            <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br/>
            Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @foreach($surats as $surat)  @php $no++; @endphp
                            <tr class="p-3">
                                <td>{{ $no }}</td>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->nm_kategori }}</td>
                                <td>{{ $surat->judul }}</td>
                                <td>{{ $surat->created_at }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm shadow-sm" onclick="confirDelete('{{ $surat->judul }}', '{{ $surat->id }}')">Hapus</button>
                                    <a class="btn btn-warning btn-sm shadow-sm" href="{{ asset('assets/filesurats/'.$surat->file_surat) }}" download>Unduh</a>
                                    <a class="btn btn-primary btn-sm shadow-sm" href="{{ url('arsip-surat/'.$surat->id) }}">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4"> 
                <a class="button-primary button-rounded shadow" href="{{ url('arsip-surat/create') }}">Arsipkan Surat...</a>
            </div>
        </div>
    </div>
</div>
@endsection