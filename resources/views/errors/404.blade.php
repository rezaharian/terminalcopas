@extends('layouts.app_public')

@section('content')
    <div class="text-center py-3">
        <img src="https://assets.dochipo.com/editor/animations/404-error/b6463d8b-ac87-42a7-ad59-6584a19a77a8.gif"
            alt="" width="50%">
        <p class="lead">Halaman yang Anda cari tidak ditemukan.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="fas fa-home me-1"></i> Kembali ke Beranda
        </a>

    </div>
@endsection
