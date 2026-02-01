@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Detail Data Buku 
@endsection

@section('container')
    <div class="title-container">
      <div>
          <h1 class="title">Data Buku</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="divider">/</li>
              <li><a href="{{ route('buku.index') }}">Data Buku</a></li>
              <li class="divider">/</li>
              <li><a href="#" class="active">Detail Buku</a></li>
          </ul>
      </div>
    </div>

    <div class="space-y-4 text-[15px] min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm">
        <div class="w-[200px] h-[250px] rounded overflow-hidden shadow">
            <img src="{{ asset('storage/image/sampul/' . $buku->sampul) }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Judul Buku</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->judul_buku }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Deskripsi Buku</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->deskripsi }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Kategori</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->kategori->nama_kategori }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Kode Buku</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->kode_buku }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Penulis</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->penulis }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Penerbit</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->penerbit }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Tanggal Terbit</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->tanggal_terbit }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Stok</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $buku->stok }}</span>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('buku.edit', $buku) }}" type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bxs-pencil' ></i> Edit
            </a>
            <form  action="{{ route('buku.destroy', $buku) }}" method="POST">
                @method('DELETE')
                @csrf
                <button id="btn-delete" data-pesan="Apakah anda ingin menghapus data ini?" type="submit" class="rounded-lg bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
                    <i class='bx bxs-trash' ></i> Hapus
                </button>
            </form>
        </div>
    </div>
  
@endsection