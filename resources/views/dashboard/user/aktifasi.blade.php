@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Halaman Pengguna Belom Aktif
@endsection

@section('container')
	<div class="title-container">
		<div>
			<h1 class="title">Data Pengguna Belom Aktif</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Aktifkan Pengguna</a></li>
			</ul>
		</div>
        {{-- <a href="{{ route('user.create') }}" class="btn-plus"><i class='bx bx-plus' ></i>Tambah Data</a> --}}
        
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
			<input type="text" value="{{ request('search') }}" name="search" placeholder="Cari data..." class="flex-1 h-full px-3 text-[15px] border-0 outline-0"/>

			<button class="w-[50px] h-full bg-blue-500 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
				<i class="bx bx-search text-lg"></i>
			</button>
		</div>

		<!-- Order By -->
		<select name="order" onchange="this.form.submit()" class="px-4 h-[40px] text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
			<option value="asc" {{ request('order') == 'asc' ? 'selected' : ''}}>Huruf A-Z</option>
			<option value="desc"{{ request('order') == 'desc' ? 'selected' : ''}}>Huruf Z-A</option>
			<option value="newest" {{ request('order') == 'newest' ? 'selected' : ''}}>Terbaru</option>
			<option value="oldest" {{ request('order') == 'oldest' ? 'selected' : ''}}>Terlama</option>
		</select>
	</form>

	<div class="overflow-x-auto rounded-xl border mt-4 border-gray-200 shadow-sm">
		<table class="min-w-full border-collapse text-sm">
			<thead class="bg-gray-100 text-gray-700">
				<tr>
					<th class="px-4 py-3 text-left font-semibold">No</th>
					<th class="px-4 py-3 text-left font-semibold hidden min-[800px]:table-cell">Pengguna</th>
					<th class="px-4 py-3 text-left font-semibold">Username</th>
					<th class="px-4 py-3 text-left font-semibold hidden min-[900px]:table-cell">Hak Akses</th>
					<th class="px-4 py-3 text-center font-semibold">Aksi</th>
				</tr>
			</thead>

			<tbody class="divide-y divide-gray-200 bg-white">
				@forelse($users as $user)
					<tr class="hover:bg-gray-50">
						<td class="px-4 py-3">{{ $loop->iteration }}</td>
						<td class="px-4 py-3 font-medium items-center gap-1.5 hidden min-[800px]:flex">
							<img src="{{ $user->profil ? asset('storage/image/profil/' . $user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $user->nama) . '&background=random&length=2'}}" class="size-8 rounded-full object-cover">
							{{ mb_strimwidth($user->nama, 0, 20, '...') }}
						</td>
						<td class="px-4 py-3 font-medium">{{ $user->username }}</td>
						<td class="px-4 py-3 font-medium hidden min-[900px]:table-cell">{{ $user->role->role }}</td>
						<td class="px-4 py-3 align-middle">
							<div class="flex items-center justify-center gap-2">
								<a href="{{ route('user.show', $user->id_user) }}" class="inline-flex items-center gap-1 rounded-lg bg-blue-500 px-3 py-1 text-xs text-white hover:bg-blue-600">
									<i class='bx bx-info-circle'></i> Detail
								</a>
                                
								<form action="{{ route('aktifasi_toggle', ['id' => $user->id_user]) }}" class="hidden min-[1000px]:block" method="POST">
									@method('PUT')
									@csrf
									<button data-pesan="Apakah Anda Yakin Ingin Mengaktifkan Data Ini ?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-green-500 px-3 py-1 text-xs text-white hover:bg-green-600">
									<i class='bx bx-check-circle'></i> Aktifasi
									</button>
								</form>
								<form action="{{ route('user.destroy', $user->id_user) }}" class="hidden min-[1000px]:block" method="POST">
									@method('DELETE')
									@csrf
									<button data-pesan="Apakah Anda Yakin Ingin Menghapus Data Ini ?" id="btn-delete" type="submit" class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1 text-xs text-white hover:bg-red-600">
									<i class='bx bx-trash'></i> Hapus
									</button>
								</form>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="100%" class="py-3 font-semibold text-center">
							Data Pengguna Kosong
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection