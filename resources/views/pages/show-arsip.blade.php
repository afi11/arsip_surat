@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-body border-0 shadow">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}">Arsip</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Lihat</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-2"><strong>Nomor</strong></div>
                <div class="col-8">{{ $surat->no_surat }}</div>
            </div>
            <div class="row">
                <div class="col-2"><strong>Kategori</strong></div>
                <div class="col-8">{{ $surat->nm_kategori }}</div>
            </div>
            <div class="row">
                <div class="col-2"><strong>Judul</strong></div>
                <div class="col-8">{{ $surat->judul }}</div>
            </div>
            <div class="row">
                <div class="col-2"><strong>Waktu Unggah</strong></div>
                <div class="col-8">{{ $surat->created_at }}</div>
            </div>
            <iframe class="mt-3 mb-3" src="{{ asset('assets/filesurats/'.$surat->file_surat) }}#toolbar=0" height="700"></iframe>
            <div class="mt-4 mb-5"> 
                <a href="{{ url()->previous() }}" class="button-secondary button-rounded">Kembali</a>
                <a href="{{ asset('assets/filesurats/'.$surat->file_surat) }}" download class="button-warning button-rounded">Unduh</a>
                <a href="{{ url('arsip-surat/'.$surat->id.'/edit') }}" class="button-primary button-rounded">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection