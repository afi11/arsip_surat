@extends('layouts.main')
@section('title', "Ubah Arsip Surat")
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
                <p>Ubah surat yang telah diunggah.</p>
                <p>Catatan : 
                  <ul class="margin-minus-10"><li>Gunakan file bermormat PDF</li></ul>
                </p>
                <div class="row align-items-center mt-2 mb-3">
                    <div class="col-md-3">
                        <label>Nomor Surat</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" id="noSurat" type="text" value="{{ $surat->no_surat }}" />
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
                                <option @if(Request::segment(3) == "edit" && $row->id == $surat->id_kategori) selected @endif value="{{ $row->id }}">{{ $row->nm_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row align-items-center mt-2 mb-3">
                    <div class="col-md-3">
                        <label>Judul Surat</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" id="judulSurat" type="text" value="{{ $surat->judul }}" />
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
                <a class="link-a" href="{{ asset('assets/filesurats/'.$surat->file_surat) }}" target="blank">
                    <ion-icon name="document-text-outline"></ion-icon> 
                    Lihat file surat</a>
                <div class="mt-5">
                    <a href="{{ url()->previous() }}" class="button-secondary button-rounded">Kembali</a>
                    <button class="button-primary button-rounded btn-arsip-surat" onclick="updateData('{{ $surat->id }}')">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
@endsection