@extends('layouts.main')
@section('title', "Tentang pembuat aplikasi")
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-body border-0 shadow">
            <div class="row justify-content-center">
                <div class="row justify-content-center"> 
                    <h4 class="text-center">Aplikasi ini dibuat oleh</h4>
                    <img class="photo-profil mt-3" src="{{ asset('assets/profil/1931713077.png') }}" />
                </div>
                <div class="margin-left-tengah mt-3">
                    <div class="row">
                        <div class="col-2">Nama</div>
                        <div class="col-10">Ahmad Fatakhul Afifudin</div>
                    </div>
                    <div class="row">
                        <div class="col-2">NIM</div>
                        <div class="col-10">1931713077</div>
                    </div>
                    <div class="row">
                        <div class="col-2">Tanggal</div>
                        <div class="col-10">22 November 2021</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection