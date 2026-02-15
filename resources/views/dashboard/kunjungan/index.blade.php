@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Halaman Kunjungan
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Data Kunjungan</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Data Kunjungan</a></li>
            </ul>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('kunjungan.create') }}" class="btn-plus"><i class='bx bx-plus' ></i>Tambah Data</a>
            <a href="{{ route('kunjungan.export') }}" class="btn-download"><i class='bx bx-download'></i>Export Excel</a>
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
            <input type="text" value='{{ request('search') }}' name="search" placeholder="Cari data sesuai nama pengunjung..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0"/>

            <button class="w-[50px] h-full bg-blue-500 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                <i class="bx bx-search text-lg"></i>
            </button>
        </div>
    </form>

    <div class="overflow-x-auto rounded-xl border mt-4 border-gray-200 shadow-sm">
        <table class="min-w-full border-collapse text-sm">
            <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">No</th>
                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                <th class="px-4 py-3 text-left font-semibold hidden min-[1000px]:table-cell">Tanggal Kunjungan</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
            @forelse($data as $kunjungan)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-medium">{{ $kunjungan->user->nama }}</td>
                    <td class="px-4 py-3 font-medium hidden min-[1000px]:table-cell">{{ $kunjungan->tanggal }}</td>
                </tr>

            @empty
                <tr>
                    <td colspan="100%" class="py-3 font-semibold text-center">
                        Data Buku Kosong
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection