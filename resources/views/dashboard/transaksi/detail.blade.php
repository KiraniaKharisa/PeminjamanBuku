@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Detail Transaksi
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Detail Data Transaksi</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="{{ route('transaksi.index') }}">Data Transaksi</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Detail</a></li>
            </ul>
        </div>
    </div>

    <div class="space-y-4 text-[15px] min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm">
        <p class="font-medium text-gray-600">Buku Yang Dipinjam</p>
        <div class="flex flex-wrap mt-2 gap-3">
            <a href="{{ route('buku.show', $transaksi->buku->id_buku) }}" class="group bg-gray-200 hover:bg-gray-300 transition cursor-pointer flex items-center rounded-lg shadow justify-center p-3 flex-col gap-3">
                <img src="{{ asset('storage/image/sampul/' . $transaksi->buku->sampul) }}" class="w-[100px] h-[125px] object-cover rounded" alt="">
                <span class="text-xs font-semibold group-hover:text-blue-600 group-hover:underline transition">{{ mb_strimwidth($transaksi->buku->judul_buku, 0, 17, '...') }}</span>
            </a>
        </div>
        <p class="font-medium text-gray-600">Peminjam Buku</p>
        <div class="flex flex-wrap mt-2 gap-3">
            <a href="{{ route('user.show', $transaksi->user->id_user) }}" class="group flex gap-1.5 items-center bg-gray-200 hover:bg-gray-300 transition rounded-full px-2.5 py-1 cursor-pointer">
                <img src="{{ $transaksi->user->profil ? asset('storage/image/profil/' . $transaksi->user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $transaksi->user->nama) . '&background=random&length=2'}}" class="size-6 rounded-full object-cover" alt="">
                <span class="text-xs font-semibold group-hover:text-blue-600 group-hover:underline transition">{{ mb_strimwidth($transaksi->user->nama, 0, 8, '...') }}</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Tanggal Pinjam</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->tanggal_pinjam }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Tanggal Kembali</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->tanggal_kembali }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Jumlah Pinjam</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->total_pinjam }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Tgl. Dibuat</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->created_at }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Status</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold">{{ $transaksi->status_label }}</span>
        </div>
        <div class="flex justify-end gap-3">
            @if ($transaksi->status == 0)
                <a href="{{ route('transaksi.edit', $transaksi) }}" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                    <i class='bx bxs-pencil' ></i> Edit
                </a>
            @endif

            <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menghapus Data Ini?" class="rounded-lg bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
                    <i class='bx bxs-trash' ></i> Hapus
                </button>
            </form>
            
            @if($transaksi->status == 0)               
                <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'disetujui']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mensetujui Data Ini?" class="rounded-lg bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 flex items-center gap-2">
                        <i class='bx bx-check' ></i> Setujui
                    </button>
                </form>
                <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'ditolak']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Menolak Data Ini?" class="rounded-lg bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
                        <i class='bx bx-check' ></i> Tolak
                    </button>
                </form>
            @elseif ($transaksi->status == 1)
               <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'dikembalikan']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mengembalikan Data Ini?" class="rounded-lg bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 flex items-center gap-2">
                        <i class='bx bx-check' ></i> Sudah Dikembalikan
                    </button>
                </form>
            @elseif ($transaksi->status == 3)
                <form action="{{ route('edit_status_transaksi', ['id' => $transaksi->id_transaksi, 'status' => 'dipulihkan']) }}" class="hidden min-[900px]:block" method="POST">
                    @method('PUT')
                    @csrf
                    <button data-pesan="Apakah Anda Yakin Ingin Memulihkan Data Ini ?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-yellow-500 px-3 py-1 text-xs text-white hover:bg-yellow-600">
                    <i class='bx bx-revision'></i> Pulihkan
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection