@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Halaman Pengajuan Transaksi
@endsection

@section('container')
	<div class="title-container">
		<div>
			<h1 class="title">Data Pengajuan Transaksi</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Data Pengajuan Transaksi</a></li>
			</ul>
		</div>
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
    </form>

	<div class="overflow-x-auto rounded-xl border mt-3 border-gray-200 shadow-sm">
    <table class="min-w-full border-collapse text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-center font-semibold">Buku</th>
                <th class="px-4 py-3 text-center font-semibold hidden min-[480px]:table-cell">User</th>
                <th class="px-4 py-3 text-center font-semibold">Pengajuan</th>
                <th class="px-4 py-3 text-center font-semibold hidden min-[1200px]:table-cell">Tgl. Pinjam</th>
                <th class="px-4 py-3 text-center font-semibold hidden min-[1200px]:table-cell">Tgl. Kembali</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($transaksi as $transaksi)
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
                <td class="px-4 py-3 text-center font-medium text-sm">{{ $transaksi->jumlah_pengajuan }}</td>
                <td class="px-4 py-3 text-center font-medium text-sm hidden min-[1200px]:table-cell">{{ $transaksi->tanggal_pinjam }}</td>
                <td class="px-4 py-3 text-center font-medium text-sm hidden min-[1200px]:table-cell">{{ $transaksi->tanggal_kembali }}</td>
                <td class="px-4 py-3 align-middle">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('transaksi.show', $transaksi->id_transaksi) }}"
                            class="inline-flex  items-center gap-1 rounded-lg bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600">
                            <i class='bx bxs-info-circle'></i> Info
                        </a>

                        <form class="hidden min-[900px]:block form-kembali" method="POST" data-judul="{{ $transaksi->buku->judul_buku }}" data-max="{{ $transaksi->jumlah_pengajuan }}" data-id="{{ $transaksi->id_transaksi }}">
                            <button id="btn-kembali" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-green-500 px-3 py-1 text-xs text-white hover:bg-green-600">
                            <i class='bx bx-check'></i> Terima Pengajuan
                            </button>
                        </form>
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

        document.querySelectorAll('#btn-kembali').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                text_error.classList.add('hidden');
                const form = e.target.closest('.form-kembali');
                const judul = form.dataset.judul;
                const maximum = form.dataset.max;
                const id = form.dataset.id;
                modal_quantity.querySelector('.header-modal-quantity h3').textContent = judul;
                modal_quantity.querySelector('#maximum').textContent = `(MAX : ${maximum})`;
                maximum_quant = Number(maximum);
                id_transaksi = id;
                

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
                text_error.innerHTML = 'tidak boleh lebih dari pengajuan'
                text_error.classList.remove('hidden');
                return;
            }

            let url = "{{ route('edit_status_transaksi', ['id' => '__ID__', 'status' => 'dikembalikan']) }}"
            url = url.replace('__ID__', id_transaksi)
            const csrf_token = "{{ csrf_token() }}"
            console.log(url);
            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'aplication/json',
                    'X-CSRF-TOKEN': csrf_token,
                    'Accept': 'aplication/json'
                },
                body: JSON.stringify({
                    is_pengajuan: true,
                    jumlah_kembali: value,
                })
            })

            closeModal();
            window.location.reload();

        })
    </script>
@endsection

