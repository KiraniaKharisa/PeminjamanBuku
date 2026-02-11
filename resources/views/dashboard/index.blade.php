@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Home Page 
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="text-xl min-[460px]:text-2xl min-[600px]:text-3xl font-bold mb-2">Selamat  {{ $salam }}, <span class="text-blue-600">{{ auth()->user()->nama }}</span> 👋</h1>
            <p class="text-xs min-[460px]:text-[13px] min-[600px]:text-sm text-gray-600">Selamat Datang! Temukan, Pinjam, dan Nikmati Buku Favorit Anda di Sini</p>
        </div>

        {{-- <a href="" class="btn-plus"> <i class='bx bx-plus' ></i>Tambah Data</a> --}}
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

  <div class="grid grid-cols-1 min-[640px]:grid-cols-2 min-[1024px]:grid-cols-3 min-[1200px]:grid-cols-4 gap-6 mt-5">

    <!-- Total Transaksi -->
    <div class="cardTrafficDashboard">
        <div class="icon-container bg-blue-100 text-blue-600">
            <i class='bx bx-transfer'></i>
        </div>
        <div>
            <p class="titleCardTrafficDashboard">Total Transaksi</p>
            <p class="countTextCardTrafficDashboard">{{ $totalTransaksi }}</p>
        </div>
    </div>

    <!-- Total User -->
    <div class="cardTrafficDashboard">
        <div class="icon-container bg-green-100 text-green-600">
            <i class='bx bx-user'></i>
        </div>
        <div>
            <p class="titleCardTrafficDashboard">Total User</p>
            <p class="countTextCardTrafficDashboard">{{ $totalUser }}</p>
        </div>
    </div>

    <!-- Total Buku -->
    <div class="cardTrafficDashboard">
        <div class="icon-container bg-yellow-100 text-yellow-600">
            <i class='bx bx-book'></i>
        </div>
        <div>
            <p class="titleCardTrafficDashboard">Total Buku</p>
            <p class="countTextCardTrafficDashboard">{{ $totalBuku }}</p>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="cardTrafficDashboard">
        <div class="icon-container bg-purple-100 text-purple-600">
            <i class='bx bx-category'></i>
        </div>
        <div>
            <p class="titleCardTrafficDashboard">Total Kategori</p>
            <p class="countTextCardTrafficDashboard">{{ $totalKategori }}</p>
        </div>
    </div>
  </div>

  <div class="bg-gray-50 rounded-lg shadow p-3 mt-5 overflow-x-auto">
    <div id="chartTraffic" class="min-w-[600px]"></div>
  </div>
  
  <div class="mt-8">
    <h3 class="font-bold text-lg min-[600px]:text-xl">Transaksi Buku Anda</h3>

    <div class="flex flex-col gap-5 mt-5">
      @foreach($transaksiKu as $transaksi)
      <a href="{{ route('buku_detail', [ 'id' => $transaksi->buku_id]) }}" class="block group relative w-full">

        <div class="flex overflow-hidden rounded-2xl bg-white/80 backdrop-blur shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg cursor-pointer">

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
                    <span class="font-medium text-gray-900">{{ $transaksi->total_pinjam }}</span>
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
  @can('admin')
    <div class="mt-8">
      <h3 class="font-bold text-lg min-[600px]:text-xl">Buku Yang Banyak Dipinjam</h3>

      <div class="flex flex-wrap gap-5 mt-5">
        @foreach ($bukuPopuler as $buku)
          
          <a href="{{ route('buku_detail', ['id' => $buku->id_buku]) }}" class="group block w-[250px] rounded-2xl bg-white/80 backdrop-blur shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
      
              <!-- Cover -->
              <div class="relative overflow-hidden rounded-t-2xl aspect-[4/5] bg-gray-100">
                  <img
                      src="{{ asset('storage/image/sampul/' . $buku->sampul) }}"
                      alt="Cover Buku"
                      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                  />
      
                  <!-- Status Badge -->
                  <span class="absolute top-3 right-3 rounded-full {{ $buku->stok <= 0 ? 'bg-red-500/90' : 'bg-emerald-500/90' }} 
                              px-3 py-1 text-xs font-medium text-white shadow">
                      {{ $buku->stok <= 0 ? 'Tidak Tersedia' : 'Tersedia' }}
                  </span>
              </div>
      
              <!-- Content -->
              <div class="p-4">
                  <h3 class="text-[15px] font-semibold text-gray-900 leading-snug line-clamp-2">
                      {{ $buku->judul_buku }}
                  </h3>
      
                  <p class="mt-1 text-xs text-gray-500">
                      {{ $buku->penulis }}
                  </p>
      
                  <!-- Footer -->
                  <div class="mt-4 flex items-center justify-between">
                      <span class="text-xs font-medium text-gray-600">
                          Stok: <span class="text-gray-900 font-semibold">{{ $buku->stok }}</span>
                      </span>
                  </div>
              </div>
          </a>
        @endforeach
          
      </div>
    </div>

    <div class="mt-8">
      <h3 class="font-bold text-lg min-[600px]:text-xl">Kategori Populer</h3>

      <div class="grid grid-cols-1 min-[950px]:grid-cols-2 min-[1100px]:grid-cols-3 mt-5 gap-3">
        @foreach ($kategoriPopuler as $kategori)
          <a href="{{ route('buku.home') }}?kategori={{ $kategori->id_kategori }}" class="group block rounded-xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:shadow-lg">

              <!-- Header -->
              <div class="flex items-start justify-between gap-3">
                  <h3 class="text-lg font-semibold text-gray-800 leading-tight line-clamp-2">
                      {{ $kategori->nama_kategori }}
                  </h3>

                  <!-- Badge total buku -->
                  <span class="shrink-0 rounded-full bg-blue-100 px-3 py-1 text-xs
                              font-medium text-blue-700">
                      {{ $kategori->buku->count() }} Buku
                  </span>
              </div>

              <!-- Divider -->
              <div class="my-4 h-px bg-gray-100"></div>

              <!-- Footer info -->
              <p  class="text-xs min-[430px]:text-sm text-gray-500 group-hover:text-gray-700 transition">
                  Lihat semua buku dalam kategori ini →
              </p>
          </a>

        @endforeach
      </div>
    </div>
  @endcan

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    var options = {
      series: [
        {
          name: 'Ditunda',
          data: {{ json_encode($bulanTransaksi['Ditunda']) }}
        }, 
        {
          name: 'Dipinjam',
          data: {{ json_encode($bulanTransaksi['Dipinjam']) }}
        }, 
        {
          name: 'Telat',
          data: {{ json_encode($bulanTransaksi['Telat']) }}
        },
        {
          name: 'Kembali',
          data: {{ json_encode($bulanTransaksi['Kembali']) }}
        },
        {
          name: 'Ditolak',
          data: {{ json_encode($bulanTransaksi['Ditolak']) }}
        }
      ],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          borderRadius: 5,
          borderRadiusApplication: 'end'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      },
      yaxis: {
        title: {
          text: 'Transaksi'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Transaksi"
          }
        }
      },
      responsive: [
        {
          breakpoint: 500,
          options: {
            chart: {
              height: 300
            }
          }
        }
      ]
    };

        var chart = new ApexCharts(document.querySelector("#chartTraffic"), options);
        chart.render();
  </script>


@endsection