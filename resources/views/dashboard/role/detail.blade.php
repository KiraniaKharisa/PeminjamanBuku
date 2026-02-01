@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Detail Hak Akses 
@endsection

@section('container')
    <div class="title-container">
      <div>
          <h1 class="title">Detail Hak Akses</h1>
          <ul class="breadcrumbs">
              <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="divider">/</li>
              <li><a href="{{ route('role.index') }}">Data Hak Akses </a></li>
              <li class="divider">/</li>
              <li><a href="#" class="active">Detail Hak Akses</a></li>
          </ul>
      </div>
    </div>

    <div class="space-y-4 text-[15px] min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Nama Hak Akses</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $role->role }}</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[140px_10px_1fr] gap-y-1">
            <span class="font-medium text-gray-600">Dibuat Pada</span>
            <span class="hidden sm:block">:</span>
            <span class="font-semibold text-gray-800">{{ $role->created_at }}</span>
        </div>
        <div class="flex flex-wrap mt-2 gap-3">
            @forelse ( $role->users as $user )                
                <a href="{{ route('user.show', $user->id_user) }}" class="group flex gap-1.5 items-center bg-gray-200 hover:bg-gray-300 transition rounded-full px-2.5 py-1 cursor-pointer">
                    <img src="{{ $user->profil ? asset('storage/image/profil/' . $user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $user->nama) . '&background=random&length=2'}}" class="size-6 rounded-full object-cover" alt="">
                    <span class="text-xs font-semibold group-hover:text-blue-600 group-hover:underline transition">{{ mb_strimwidth($user->name, 0, 8, '...') }}</span>
                </a>
            @empty
                <p class="flex items-center gap-2"><i class="bx bxs-book text-gray-400"></i>Data Role Tidak Ada Data User</p>
            @endforelse
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('role.edit', $role) }}" type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bxs-pencil' ></i> Edit
            </a>
            <form action="{{ route('role.destroy', $role) }}" method="POST">
                @method('DELETE')
                @csrf
                <button id="btn-delete" data-pesan="Apakah Anda yakin ingin menghapus data role ini?"  type="submit" class="rounded-lg bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
                    <i class='bx bxs-trash' ></i> Hapus
                </button>
            </form>
        </div>
    </div>    
  
@endsection