@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Halaman Buku
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Data Buku</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Data Buku</a></li>
            </ul>
        </div>

        <a href="{{ route('buku.create') }}" class="btn-plus"> <i class='bx bx-plus' ></i>Tambah Data</a>
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
            <input type="text" value='{{ request('search') }}' name="search" placeholder="Cari data sesuai judul atau kode buku..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0"/>

            <button class="w-[50px] h-full bg-blue-500 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                <i class="bx bx-search text-lg"></i>
            </button>
        </div>


        <!-- Order By -->
        <select name="order" onchange="this.form.submit()" class="px-4 h-[40px] text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Huruf A - Z</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Huruf Z - A</option>
            <option value="newest" {{ request('order') == 'newest' ? 'selected' : '' }}>Terbaru</option>
            <option value="oldest" {{ request('order') == 'oldest' ? 'selected' : '' }}>Terlama</option>
        </select>
    </form>

    <div class="overflow-x-auto rounded-xl border mt-4 border-gray-200 shadow-sm">
        <table class="min-w-full border-collapse text-sm">
            <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">No</th>
                <th class="px-4 py-3 text-left font-semibold">Buku</th>
                <th class="px-4 py-3 text-left font-semibold hidden min-[1000px]:table-cell">Kategori</th>
                <th class="px-4 py-3 text-left font-semibold hidden min-[1000px]:table-cell">Stok</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
            @forelse($books as $buku)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-medium flex items-center gap-2">
                        <img src="{{ asset('storage/image/sampul/' . $buku->sampul) }}" class="w-[100px] h-[125px] hidden min-[550px]:block rounded-sm object-cover"/>
                        {{ mb_strimwidth($buku->judul_buku, 0, 20, '...') }}
                    </td>
                    <td class="px-4 py-3 font-medium hidden min-[1000px]:table-cell">{{ $buku->kategori->nama_kategori }}</td>
                    <td class="px-4 py-3 font-medium hidden min-[1000px]:table-cell">{{ $buku->stok }}</td>
                    <td class="px-4 py-3 align-middle">
                        <div class="flex justify-center gap-2">
                        <a href="{{ route('buku.show', $buku->id_buku) }}"
                            class="inline-flex items-center gap-1 rounded-lg bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600">
                            <i class='bx bxs-info-circle'></i> Info
                        </a>
                        <a href="{{ route('buku.edit', $buku->id_buku) }}"
                            class="hidden min-[900px]:inline-flex items-center gap-1 rounded-lg bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600">
                            <i class='bx bxs-pencil'></i> Edit
                        </a>

                        <form action="{{ route('buku.destroy', $buku->id_buku) }}" class="hidden min-[900px]:block" method="POST">
                            @method('DELETE')
                            @csrf
                            <button id="btn-delete" data-pesan="Apakah Anda yakin ingin menghapus data buku ini?" type="submit"
                                    class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1 text-xs text-white hover:bg-red-600">
                            <i class='bx bxs-trash'></i> Hapus
                            </button>
                        </form>
                        </div>
                    </td>
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