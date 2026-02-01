@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Detail Kategori 
@endsection

@section('container')
    <div class="title-container">
      <div>
          <h1 class="title">Data Kategori</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="divider">/</li>
              <li><a href="{{ route('kategori.index') }}">Data Kategori</a></li>
              <li class="divider">/</li>
              <li><a href="#" class="active">Detail Kategori</a></li>
          </ul>
      </div>
    </div>

    <div class="space-y-4 text-[15px] min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Nama Kategori</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $kategori->nama_kategori }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Dibuat Pada</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $kategori->created_at }}</span>
        </div>
        <div class="flex flex-wrap mt-2 gap-3">
            @forelse ( $kategori->buku as $buku )                
                <a href="{{ route('buku.show', $buku->id_buku) }}" class="group bg-gray-200 hover:bg-gray-300 transition cursor-pointer flex items-center rounded-lg shadow justify-center p-3 flex-col gap-3">
                    <img src="{{ asset('storage/image/sampul/' . $buku->sampul) }}" class="w-[100px] h-[125px] object-cover rounded" alt="">
                    <span class="text-xs font-semibold group-hover:text-blue-600 group-hover:underline transition">{{ mb_strimwidth($buku->judul_buku, 0, 17, '...') }}</span>
                </a>
            @empty
                <p class="flex items-center gap-2"><i class="bx bxs-book text-gray-400"></i>Data Kategori Tidak Ada Data Buku</p>
            @endforelse
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('kategori.edit', $kategori) }}" type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bxs-pencil' ></i> Edit
            </a>
            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST">
                @method('DELETE')
                @csrf
                <button id="btn-delete" data-pesan="Apakah Anda yakin ingin menghapus data kategori ini?"  type="submit" class="rounded-lg bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
                    <i class='bx bxs-trash' ></i> Hapus
                </button>
            </form>
        </div>
    </div>    
  
@endsection