@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Detail Pengguna 
@endsection

@section('container')
    <div class="title-container">
      <div>
          <h1 class="title">Data Pengguna</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="divider">/</li>
              <li><a href="{{ route('user.index') }}">Data Pengguna</a></li>
              <li class="divider">/</li>
              <li><a href="#" class="active">Detail Pengguna</a></li>
          </ul>
      </div>
    </div>

    <div class="space-y-4 text-[15px] min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm">
        <div class="size-25 rounded-full overflow-hidden shadow">
            <img src="{{ $user->profil ? asset('storage/image/profil/' . $user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $user->nama) . '&background=random&length=2'}}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Nama</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $user->nama }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Username</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $user->username }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Hak Akses</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $user->role->role }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Akun Dibuat Pada</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $user->created_at }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">User Aktif</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $user->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
        </div>
        <div class="flex justify-end gap-3">          
            <a href="{{ route('user.edit', $user) }}" type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bxs-pencil' ></i> Edit
            </a>
            
            <form action="{{ route('aktifasi_toggle', ['id' => $user->id_user]) }}" method="POST">
                @method('PUT')
                @csrf
                <button id="btn-delete" data-pesan="Apakah Anda Yakin Ingin Mengaktifasi Data Ini" type="submit" class="rounded-lg {{ $user->is_aktif == 0 ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} px-5 py-2 text-sm font-medium text-white flex items-center gap-2">
                    {!! $user->is_aktif == 0
                        ? "<i class='bx bx-check-circle'></i> Aktifasi"
                        : "<i class='bx bx-x'></i> Nonaktif"
                    !!}
                </button>
            </form>
            <form action="{{ route('user.destroy', $user) }}" method="POST">
                @method('DELETE')
                @csrf
                <button id="btn-delete" data-pesan="Apakah Anda yakin ingin menghapus data user ini?" type="submit" class="rounded-lg bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
                    <i class='bx bxs-trash' ></i> Hapus
                </button>
            </form>
        </div>
    </div>
  
@endsection