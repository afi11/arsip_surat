@extends('layouts.main')
@section('title', "Tambah Arsip Surat")
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-body border-0 shadow">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ url('/') }}">Arsip</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Unggah</li>
                    </ol>
                </nav>
                <p>Unggah surat yang telah terbit pada form dibawah ini untuk diarsipkan.</p>
                <p>Catatan : 
                  <ul class="margin-minus-10"><li>Gunakan file bermormat PDF</li></ul>
                </p>
                {{-- <iframe type="application/pdf" src="{{ asset('assets/filesurats/Sertifikat.pdf') }}" width="600" height="400"></iframe> --}}
                <div class="row align-items-center mt-2 mb-3">
                    <div class="col-md-3">
                        <label>Nomor Surat</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" id="noSurat" type="text" />
                    </div>
                </div>
                <div class="row align-items-center mt-2 mb-3">
                    <div class="col-md-3">
                        <label>Kategori</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select" id="kategoriSurat">
                            <option value="">Pilih kategori</option>
                            @foreach($kategori as $row)
                                <option value="{{ $row->id }}">{{ $row->nm_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row align-items-center mt-2 mb-3">
                    <div class="col-md-3">
                        <label>Judul Surat</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" id="judulSurat" type="text" />
                    </div>
                </div>
                <div class="row align-items-center mt-2 mb-3">
                    <div class="col-md-3">
                        <label>File Surat (pdf)</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="file" id="formFile" onchange="pickFileSurat()" />
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{ url()->previous() }}" class="button-secondary button-rounded">Kembali</a>
                    <button class="button-primary button-rounded btn-arsip-surat" onclick="submitData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection