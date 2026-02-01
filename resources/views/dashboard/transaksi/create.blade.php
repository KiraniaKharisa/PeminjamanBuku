@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Buat Data Transaksi
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Buat Data Transaksi</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="{{ route('transaksi.index') }}">Data Transaksi</a></li>
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

    <form method="POST" action="{{ route('transaksi.store') }}" class="min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm space-y-4">
        @csrf

        <!--- Select Option Buku -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Pilih Buku</label>
            <select name="buku_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach ($buku as $buku) 
                    @if(old('buku_id') == $buku->id_buku)
                        <option value="{{ $buku->id_buku }}" selected>({{ $buku->kode_buku }}) - {{ $buku->judul_buku }} (Stok : {{ $buku->stok }})</option>
                    @else  
                        <option value="{{ $buku->id_buku }}">({{ $buku->kode_buku }}) - {{ $buku->judul_buku }} (Stok : {{ $buku->stok }})</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('buku_id')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!--- Select Option User -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Pilih Pengguna</label>
            <select name="user_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach ($user as $user) 
                    @if(old('user_id') == $user->id_user)
                        <option value="{{ $user->id_user }}" selected>({{ $user->username }}) - {{ $user->nama }}</option>
                    @else  
                        <option value="{{ $user->id_user }}">({{ $user->username }}) - {{ $user->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('user_id')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Date -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Tanggal Pinjam</label>
            <input type="date" value="{{ old('tanggal_pinjam') }}" name="tanggal_pinjam" placeholder="Masukkan Tanggal Pinjam Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('tanggal_pinjam')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Date -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Tanggal Kembali</label>
            <input type="date" value="{{ old('tanggal_kembali') }}" name="tanggal_kembali" placeholder="Masukkan Tanggal Kembali Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('tanggal_kembali')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Input Date -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Jumlah Buku</label>
            <input type="number" value="{{ old('total_pinjam') }}" name="total_pinjam" placeholder="Masukkan Jumlah Buku..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('total_pinjam')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!--- Select Option Status -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">status</label>
            <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="0" {{ old('status') == "0" ? "selected" : '' }}>Ditunda</option>
                <option value="1" {{ old('status') == "1" ? "selected" : '' }}>Disetujui</option>
                <option value="2" {{ old('status') == "2" ? "selected" : '' }}>Dikembalikan</option>
                <option value="3" {{ old('status') == "3" ? "selected" : '' }}>Ditolak</option>
            </select>
        </div>
        @error('status')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-plus' ></i> Tambah
            </button>
        </div>
    </form>
@endsection