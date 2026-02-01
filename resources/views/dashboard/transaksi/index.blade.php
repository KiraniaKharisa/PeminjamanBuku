@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Halaman Transaksi
@endsection

@section('container')
	<div class="title-container">
		<div>
			<h1 class="title">Data Transaksi</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Data Transaksi</a></li>
			</ul>
		</div>
        <a href="{{ route('transaksi.create') }}" class="btn-plus"> <i class='bx bx-plus' ></i>Tambah Data</a>
	</div>

	{{-- Success Alert --}}
	@if (@session()->has('sukses'))
		<div class="flex mt-3 items-center gap-3 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700">
			<i class='bx bx-check-circle text-lg'></i>
			<span>{{ session('sukses') }}</span>
		</div>
	@endif

	{{-- Error Alert --}}
    @if (@session()->has('error'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            <i class='bx bx-x-circle text-lg'></i>
            <span>{{ session('error') }}</span>
        </div>  
    @endif

	<form action="" method="GET" class="flex justify-end items-end min-[600px]:items-center flex-col min-[600px]:flex-row gap-2 mt-5">
        <!-- Search -->
        <div class="flex items-center w-full max-w-[400px] h-[40px] border rounded-lg overflow-hidden">
            <input type="text" value='{{ request('search') }}' name="search" placeholder="Cari data sesuai ID Transaksi..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0"/>

            <button class="w-[50px] h-full bg-blue-500 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                <i class="bx bx-search text-lg"></i>
            </button>
        </div>


        <!-- Order By -->
        <select name="order" onchange="this.form.submit()" class="px-4 h-[40px] text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="newest" {{ request('order') == 'newest' ? 'selected' : '' }}>Terbaru</option>
            <option value="oldest" {{ request('order') == 'oldest' ? 'selected' : '' }}>Terlama</option>
        </select>

        <!-- Status Filter By -->
        <select name="status_filter" onchange="this.form.submit()" class="px-4 h-[40px] text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="tertunda" {{ request('status_filter') == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
            <option value="dipinjam" {{ request('status_filter') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="terlambat" {{ request('status_filter') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
            <option value="dikembalikan" {{ request('status_filter') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="ditolak" {{ request('status_filter') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </form>

	<div class="overflow-x-auto rounded-xl border mt-3 border-gray-200 shadow-sm">
    <table class="min-w-full border-collapse text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-center font-semibold">Buku</th>
                <th class="px-4 py-3 text-center font-semibold hidden min-[480px]:table-cell">User</th>
                <th class="px-4 py-3 text-center font-semibold hidden min-[1200px]:table-cell">Tgl. Pinjam</th>
                <th class="px-4 py-3 text-center font-semibold hidden min-[1200px]:table-cell">Tgl. Kembali</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($transaksis as $transaksi)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    <a href="{{ route('buku.show', $transaksi->buku->id_buku) }}" class="group transition cursor-pointer flex items-center rounded-lg justify-center p-3 flex-col gap-3">
                        <img src="{{ asset('storage/image/sampul/' . $transaksi->buku->sampul) }}" class="w-[100px] h-[125px] object-cover rounded" alt="">
                        <span class="text-xs font-semibold group-hover:text-blue-600 group-hover:underline transition">{{ mb_strimwidth($transaksi->buku->judul_buku, 0, 17, '...') }}</span>
                    </a>
                </td>
                <td class="px-4 py-3 font-medium hidden min-[480px]:table-cell">
                    <a href="{{ route('user.show', $transaksi->user->id_user) }}" class="group flex flex-col gap-1.5 items-center transition rounded-full px-2.5 py-1 cursor-pointer">
                        <img src="{{ $transaksi->user->profil ? asset('storage/image/profil/' . $transaksi->user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $transaksi->user->nama) . '&background=random&length=2'}}" class="size-12 rounded-full object-cover" alt="">
                        <span class="text-sm font-semibold group-hover:text-blue-600 group-hover:underline transition">{{ mb_strimwidth($transaksi->user->nama, 0, 8, '...') }}</span>
                    </a>
                </td>
                <td class="px-4 py-3 text-center font-medium text-sm hidden min-[1200px]:table-cell">{{ $transaksi->tanggal_pinjam }}</td>
                <td class="px-4 py-3 text-center font-medium text-sm hidden min-[1200px]:table-cell">{{ $transaksi->tanggal_kembali }}</td>
                <td class="px-4 py-3 align-middle">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('transaksi.show', $transaksi->id_transaksi) }}"
                            class="inline-flex  items-center gap-1 rounded-lg bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600">
                            <i class='bx bxs-info-circle'></i> Info
                        </a>

                        @if($transaksi->status == 0)
                            <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'disetujui']) }}" class="hidden min-[900px]:block" method="POST">
                                @method('PUT')
                                @csrf
                                <button data-pesan="Apakah Anda Yakin Ingin Mensetujui Data Ini ?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-green-500 px-3 py-1 text-xs text-white hover:bg-green-600">
                                <i class='bx bx-check'></i> Setuju
                                </button>
                            </form>

                            <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'ditolak']) }}" class="hidden min-[900px]:block" method="POST">
                                @method('PUT')
                                @csrf
                                <button data-pesan="Apakah Anda Yakin Ingin Menolak Data Ini ?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1 text-xs text-white hover:bg-red-600">
                                <i class='bx bx-x'></i> Tolak
                                </button>
                            </form>
                        @elseif ($transaksi->status == 1)
                            <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'dikembalikan']) }}" class="hidden min-[900px]:block" method="POST">
                                @method('PUT')
                                @csrf
                                <button data-pesan="Apakah Anda Yakin Data Ini Sudah Dikembalikan?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-green-500 px-3 py-1 text-xs text-white hover:bg-green-600">
                                <i class='bx bx-check'></i> Sudah Dikembalikan
                                </button>
                            </form>
                        @elseif ($transaksi->status == 3)
                            <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'dipulihkan']) }}" class="hidden min-[900px]:block" method="POST">
                                @method('PUT')
                                @csrf
                                <button data-pesan="Apakah Anda Yakin Ingin Mengembalikan Data Ini ?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-yellow-500 px-3 py-1 text-xs text-white hover:bg-yellow-600">
                                <i class='bx bx-revision'></i> Pulihkan
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="py-3 font-semibold text-center">
                    Data Transaksi Kosong
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
