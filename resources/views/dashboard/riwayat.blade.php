@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Riwayat Transaksi
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Riwayat Transaksi</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Riwayat</a></li>
            </ul>
        </div>
    </div>

    <form action="" method="GET" class="flex justify-end items-end min-[600px]:items-center flex-col min-[600px]:flex-row gap-2 mt-5">
        <!-- Search -->
        <div class="flex items-center w-full max-w-[400px] h-[40px] border rounded-lg overflow-hidden">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data sesuai judul buku atau kode buku..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0"/>

            <button class="w-[50px] h-full bg-blue-500 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                <i class="bx bx-search text-lg"></i>
            </button>
        </div>

    </form>

    @foreach ($transaksiPerBulan as $bulan)
        <div class="mt-5 mx-3">
            <h1 class="font-fredoka font-semibold mb-1 text-xl">{{ $bulan['label'] }}</h1>
            <div class="flex flex-col gap-5 mt-2">
                @foreach ($bulan['items'] as $transaksi)
                    <a href="{{ route('buku_detail', ['id' => $transaksi->buku_id]) }}" class="block group relative w-full">
                        <div class="flex flex-col min-[500px]:flex-row overflow-hidden rounded-2xl bg-white/80 backdrop-blur shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                
                            <!-- Status Badge -->
                            <span @class([
                                'absolute right-3 top-3 z-10 rounded-full px-3 py-1 text-xs font-medium text-white shadow',
                
                                'bg-red-500'   => in_array($transaksi->status_label, ['Ditolak', 'Terlambat']),
                                'bg-amber-500' => $transaksi->status_label === 'Dipinjam',
                                'bg-blue-500'  => $transaksi->status_label === 'Ditunda',
                                'bg-green-500' => $transaksi->status_label === 'Dikembalikan',
                            ])>
                                {{ $transaksi->status_label }}
                            </span>
                
                            <!-- Cover -->
                            <div class="w-[120px] aspect-[4/5] shrink-0 bg-gray-100 overflow-hidden">
                                <img
                                    src="{{ asset('storage/image/sampul/' . $transaksi->buku->sampul) }}"
                                    alt="Cover Buku"
                                    class="h-full w-full object-cover transition-transform 
                                        duration-500 group-hover:scale-105"
                                />
                            </div>
                
                            <!-- Content -->
                            <div class="flex flex-col p-4 flex-1">
                                <!-- Header -->
                                <div class="pr-24">
                                    <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-2">
                                        {{ $transaksi->buku->judul_buku }}
                                    </h3>
                
                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $transaksi->buku->penulis }}
                                    </p>
                                </div>
                
                                <div class="flex-1"></div>
                
                                <!-- Transaction Info -->
                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-xs text-gray-600">
                                    <p><span class="text-gray-400">ID Transaksi</span><br>
                                    <span class="font-medium text-gray-900">{{ $transaksi->id_transaksi }}</span>
                                    </p>
                
                                    <p><span class="text-gray-400">Total Peminjaman</span><br>
                                    <span class="font-medium text-gray-900">{{ $transaksi->total_pinjam }} Buku</span>
                                    </p>
                
                                    <p><span class="text-gray-400">Tanggal Pinjam</span><br>
                                    <span class="font-medium text-gray-900">{{ $transaksi->tanggal_pinjam }}</span>
                                    </p>
                
                                    <p><span class="text-gray-400">Tanggal Kembali</span><br>
                                    <span class="font-medium text-gray-900">{{ $transaksi->tanggal_kembali }}</span>
                                    </p>
                
                                    <p><span class="text-gray-400">Transaksi Dibuat</span><br>
                                    <span class="font-medium text-gray-900">{{ $transaksi->created_at }}</span>
                                    </p>
                
                                    <p><span class="text-gray-400">Terakhir Diubah</span><br>
                                    <span class="font-medium text-gray-900">{{ $transaksi->updated_at }}</span>
                                    </p>
                                </div>
                            </div>
                
                        </div>
                    </a>
                @endforeach
            
        
            </div>
        </div>
    @endforeach


@endsection