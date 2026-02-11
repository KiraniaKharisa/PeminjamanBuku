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
            <span class="font-medium text-gray-600">Pinjaman Awal</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->total_pinjam }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Dikembalikan</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->jumlah_dikembalikan }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Pinjaman Saat Ini</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->pinjamanSaatIni }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Sedang Diajukan</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->ajukan_pengembalian ? 'Iya' : 'Tidak Diajukan' }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Jumlah Diajukan</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $transaksi->jumlah_pengajuan }}</span>
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
               <form data-judul="{{ $transaksi->buku->judul_buku }}" data-max="{{ $transaksi->pinjamanSaatIni }}" data-id="{{ $transaksi->id_transaksi }}" data-ispengajuan='false' class="form-kembali">
                    <button type="submit" id="btn-kembalikan" class="rounded-lg bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 flex items-center gap-2">
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

            @if($transaksi->ajukan_pengembalian)
                <form data-judul="{{ $transaksi->buku->judul_buku }}" data-max="{{ $transaksi->jumlah_pengajuan }}" data-id="{{ $transaksi->id_transaksi }}" data-ispengajuan='true' class="form-kembali">
                    <button type="submit" id="btn-kembalikan" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                        <i class='bx bx-check' ></i> Terima Pengajuan
                    </button>
                </form>
            @endif
        </div>
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
        let is_pengajuan = false;

        document.querySelectorAll('#btn-kembalikan').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                text_error.classList.add('hidden');
                const form = e.target.closest('.form-kembali');
                const judul = form.dataset.judul;
                const maximum = form.dataset.max;
                const id = form.dataset.id;
                is_pengajuan = form.dataset.ispengajuan;
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
            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'aplication/json',
                    'X-CSRF-TOKEN': csrf_token,
                    'Accept': 'aplication/json'
                },
                body: JSON.stringify({
                    is_pengajuan: is_pengajuan == 'true' ? true : false,
                    jumlah_kembali: value,
                })
            })

            closeModal();
            window.location.reload();

        })
    </script>
@endsection
