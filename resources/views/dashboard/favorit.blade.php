@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Koleksi Buku
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Koleksi Buku</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Koleksi</a></li>
            </ul>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session()->has('sukses'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
            <i class='bx bx-check-circle text-lg'></i>
            <span>{{ session('sukses') }}</span>
        </div>
    @endif

    {{-- Error Alert --}}
    @if(session()->has('error'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            <i class='bx bx-x-circle text-lg'></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form action="" method="GET" class="flex justify-end items-end min-[600px]:items-center flex-col min-[600px]:flex-row gap-2 mt-5">
        <!-- Search -->
        <div class="flex items-center w-full max-w-[400px] h-[40px] border rounded-lg overflow-hidden">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data sesuai judul buku atau kode buku..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0"/>

            <button class="w-[50px] h-full bg-blue-500 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                <i class="bx bx-search text-lg"></i>
            </button>
        </div>
    </form>

    <div class="grid grid-cols-1 min-[1200px]:grid-cols-2 mt-5 gap-5">
        @foreach ($bukuFavorit as $favorit)
            <a class="card_koleksi">
                <form action="{{ route('favorit_delete', ['id' => $favorit->id_favorit]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="hapus_koleksi" id="btn-delete" data-pesan="Anda Yakin Ingin Menghapus Koleksi Ini ?"><i class="bx bxs-trash"></i></button>
                </form>
                <img src="{{ asset('storage/image/sampul/' . $favorit->buku->sampul) }}" alt="Gambar Wisata">
                <div class="info_koleksi">
                <h4>{{ $favorit->buku->judul_buku }}</h4>
                    <div class="kategori_koleksi">
                        <span>{{ $favorit->buku->kategori->nama_kategori }}</span>
                    </div>
                    <p>Penulis : {{ $favorit->buku->penulis }}</p>
                    <p>Penerbit : {{ $favorit->buku->penerbit }}</p>
                    <p>Tgl Terbit : {{ $favorit->buku->tanggal_terbit }}</p>
                </div>
            </a>
        @endforeach
    </div>


@endsection