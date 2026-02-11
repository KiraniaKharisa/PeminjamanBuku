@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Ajukan Pengembalian
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Ajukan Pengembalian</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Pengembalian</a></li>
            </ul>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session()->has('sukses'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-green-500 bg-green-500/10 px-4 py-3 text-sm text-green-700 dark:text-text-white">
            <i class='bx bx-check-circle text-lg'></i>
            <span>{{ session('sukses') }}</span>
        </div>
    @endif

    {{-- Error Alert --}}
    @if(session()->has('error'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-500 bg-red-500/10 px-4 py-3 text-sm text-red-700 dark:text-text-white">
            <i class='bx bx-x-circle text-lg'></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form action="" method="GET" class="flex justify-end items-end min-[600px]:items-center flex-col min-[600px]:flex-row gap-2 mt-5">
        <!-- Search -->
        <div class="flex items-center w-full max-w-[400px] h-[40px] border rounded-lg overflow-hidden">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data sesuai judul buku atau kode buku..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0 placeholder:text-gray-text"/>

            <button class="w-[50px] h-full bg-blue text-text-white focus:ring-2 focus:ring-blue">
                <i class="bx bx-search text-lg"></i>
            </button>
        </div>

    </form>

    @forelse ($transaksiPerBulan as $bulan)
        <div class="mt-5 mx-3">
            <h1 class="font-fredoka font-semibold mb-1 text-xl">{{ $bulan['label'] }}</h1>
            <div class="flex flex-col gap-5 mt-2">
                @foreach ($bulan['items'] as $transaksi)
                    <a data-judul='{{ $transaksi->buku->judul_buku }}' data-pengajuan='{{ $transaksi->jumlah_pengajuan }}' data-id='{{ $transaksi->id_transaksi }}' data-max='{{ $transaksi->total_pinjam - $transaksi->jumlah_dikembalikan }}' href="{{ route('buku_detail', ['id' => $transaksi->buku_id]) }}" class="block group relative w-full card_transaksi">
                        <div class="flex flex-col min-[500px]:flex-row overflow-hidden rounded-2xl bg-background backdrop-blur shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">

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
                            <div class="w-[120px] aspect-[4/5] shrink-0 overflow-hidden">
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
                                    <h3 class="text-sm font-semibold text-text leading-snug line-clamp-2">
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
                                    <span class="font-medium text-text">{{ $transaksi->id_transaksi }}</span>
                                    </p>

                                    @if($transaksi->ajukan_pengembalian)
                                        <p><span class="text-gray-400">Total Diajukan</span><br>
                                        <span class="font-medium text-text">{{ $transaksi->jumlah_pengajuan }} Buku</span>
                                        </p>
                                    @else
                                        <p><span class="text-gray-400">Total Peminjaman</span><br>
                                        <span class="font-medium text-text">{{ $transaksi->pinjamanSaatIni }} Buku</span>
                                        </p>
                                    @endif

                                    <p><span class="text-gray-400">Tanggal Pinjam</span><br>
                                    <span class="font-medium text-text">{{ $transaksi->tanggal_pinjam }}</span>
                                    </p>

                                    <p><span class="text-gray-400">Tanggal Kembali</span><br>
                                    <span class="font-medium text-text">{{ $transaksi->tanggal_kembali }}</span>
                                    </p>

                                    <p><span class="text-gray-400">Transaksi Dibuat</span><br>
                                    <span class="font-medium text-text">{{ $transaksi->created_at }}</span>
                                    </p>

                                    <p><span class="text-gray-400">Terakhir Diubah</span><br>
                                    <span class="font-medium text-text">{{ $transaksi->updated_at }}</span>
                                    </p>
                                </div>
                                
                                <div class="flex flex-col min-[820px]:flex-row gap-x-5">
                                    @if($transaksi->ajukan_pengembalian)
                                        <form action="{{ route('batalkan_pengajuan', ['id' => $transaksi->id_transaksi]) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" id="btn-delete" data-pesan="Apakah anda yakin ingin membatalkan pengajuan" class="btn-danger-detail w-full mt-4 justify-center">Batalkan Pengajuan</button>
                                        </form>
                                    @endif
                                    <button  type="button" class="btn-detail text-white {{ $transaksi->ajukan_pengembalian ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }} pengembalian_btn mt-4 justify-center">{{ $transaksi->ajukan_pengembalian ? 'Sudah diajukan, Edit Pengajuan' : 'Ajukan Pengembalian' }}</button>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            
        
            </div>
        </div>
    @empty
        <h3 class="text-base font-semibold text-center my-10">Data Buku Yang Dipinjam Kosong</h3>
    @endforelse
@endsection

@section('modal')
    <div class="bgblur" style="z-index: 999 !important;"></div>
    <div class="modal-quantity">
        
        <!-- Header Modal -->
        <div class="header-modal-quantity">
            <h3>
                Laskar Pelangi
            </h3>
            <p>Masukkan jumlah buku yang ingin dikembalikan.</p>
        </div>

        <!-- Body Modal -->
        <div class="body-modal-quantity">
            <label for="quantity">
                Jumlah Pengembalian <span id="maximum">(MAX 11)</span>
            </label>
            <input type="number" id="quantity" min="1" placeholder="Contoh: 1">
            <p class="text-sm text-red-500 mt-1 text-error-modal hidden">Error</p>
        </div>

        <!-- Footer Modal -->
        <div class="footer-modal-quantity">
            <button id="btn_kirim">
                Kembalikan
            </button>
            <button id="btn_close">
                Batal
            </button>
        </div>
    </div>

    <script>
        const modal_quantity = document.querySelector('.modal-quantity');
        const bgblur = document.querySelector('.bgblur'); 
        const btn_close = document.querySelector('#btn_close');
        const text_error = document.querySelector('.text-error-modal');
        const inputQuantity = modal_quantity.querySelector('.body-modal-quantity input');
        let maximum_quant = 0;
        let id_transaksi = 0;

        document.querySelectorAll('.pengembalian_btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                text_error.classList.add('hidden');
                const card = e.target.closest('.card_transaksi');
                const judul = card.dataset.judul;
                const maximum = card.dataset.max;
                const id = card.dataset.id;
                const pengajuan = card.dataset.pengajuan;
                modal_quantity.querySelector('.header-modal-quantity h3').textContent = judul;
                modal_quantity.querySelector('#maximum').textContent = `(MAX : ${maximum})`;
                maximum_quant = Number(maximum);
                id_transaksi = id;
                inputQuantity.value = pengajuan;
                

                bgblur.classList.add('active');
                modal_quantity.classList.add('active');
            });
        });

        function closeModal() {
            modal_quantity.classList.remove("active");
            setTimeout(() => {
                bgblur.classList.remove("active");
            }, 500);
        }

        btn_close.addEventListener('click', closeModal)
        window.addEventListener('click', (e) => {

            // kalau klik di DALAM modal → abaikan
            if (modal_quantity.contains(e.target)) return;

            // selain itu → tutup modal
            closeModal();
        });

        document.querySelector('#btn_kirim').addEventListener('click', (e) => {
            e.preventDefault();
            text_error.classList.add('hidden');
            const value = Number(inputQuantity.value);
            
            if(value <= 0 || value == null || value == '') {
                text_error.innerHTML = 'harus diisi atau tidak sama dengan 0'
                text_error.classList.remove('hidden');
                return;
            } 

            if(value > maximum_quant) {
                text_error.innerHTML = 'tidak boleh lebih dari peminjaman'
                text_error.classList.remove('hidden');
                return;
            }

            const url = "{{ route('pengembalian_update') }}"
            const csrf_token = "{{ csrf_token() }}"
            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'aplication/json',
                    'X-CSRF-TOKEN': csrf_token,
                    'Accept': 'aplication/json'
                },
                body: JSON.stringify({
                    jumlah_pengajuan: value,
                    id_transaksi: id_transaksi,
                })
            })

            closeModal();
            window.location.reload();

        })
    </script>
@endsection