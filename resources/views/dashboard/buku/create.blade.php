@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Buat Data Buku
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Buat Data Buku</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="{{ route('buku.index') }}">Data Buku</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Tambah</a></li>
            </ul>
        </div>

    </div>

    {{-- Error Alert --}}
    @if(session()->has('error'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            <i class='bx bx-x-circle text-lg'></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('buku.store') }}" class="min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm space-y-4">
        @csrf
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Judul Buku</label>
            <input type="text" value="{{ old('judul_buku') }}" name="judul_buku" placeholder="Masukkan Judul Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('judul_buku')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Kode Buku</label>
            <input type="text" value="{{ old('kode_buku') }}" name="kode_buku" placeholder="Masukkan Kode Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('kode_buku')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Penulis Buku</label>
            <input type="text" value="{{ old('penulis') }}" name="penulis" placeholder="Masukkan Penulis Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('penulis')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Penerbit Buku</label>
            <input type="text" value="{{ old('penerbit') }}" name="penerbit" placeholder="Masukkan Penerbit Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('penerbit')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Date -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Tanggal Terbit</label>
            <input type="date" value="{{ old('tanggal_terbit') }}" name="tanggal_terbit" placeholder="Masukkan Tanggal Terbit Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('tanggal_terbit')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Date -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Stok Buku</label>
            <input type="number" value="{{ old('stok') }}" name="stok" placeholder="Masukkan Stok Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('stok')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!--- Select Option Kategori -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Kategori</label>
            <select name="kategori_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach ($kategoris as $kategori) 
                    @if(old('kategori_id') == $kategori->id_kategori)
                        <option value="{{ $kategori->id_kategori }}" selected>{{ $kategori->nama_kategori }}</option>
                    @else  
                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('kategori_id')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Deskripsi Buku</label>
            <textarea name="deskripsi" placeholder="Masukkan Deskripsi Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
        </div>
        @error('deskripsi')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <label class="text-sm font-medium text-gray-700 mt-5">Pilih Sampul Buku</label>
        <div id="avatarWrapper" data-isrequired="true" class="w-[100px] h-[125px] group rounded overflow-hidden relative cursor-pointer">

            <div class="absolute inset-0 bg-black/40 flex items-center justify-center
                        opacity-0 group-hover:opacity-100 transition z-100">
                <i id="avatarIcon" class="bx bxs-pencil text-white text-xl"></i>
            </div>

            <input type="file" id="avatarInput" name="sampul" accept="image/*" class="hidden">

            <img id="avatarPreview"
                data-defaultsrc="https://placehold.co/100x125"
                src="https://placehold.co/100x125"
                class="size-full rounded object-cover">
        </div>
        @error('sampul')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-plus' ></i> Tambah
            </button>
        </div>

    </form>

    @vite('resources/js/image_previewer.js')

@endsection