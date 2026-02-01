@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Tambah User
@endsection

@section('container')
	<div class="title-container">
		<div>
			<h1 class="title">Tambah Data Pengguna</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="divider">/</li>
				<li><a href="{{ route('user.index') }}">Data Pengguna</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Tambah</a></li>
			</ul>
		</div>		
	</div>

    {{-- Error Alert --}}
    @if (@session()->has('error'))
        <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            <i class='bx bx-x-circle text-lg'></i>
            <span>{{ session('error') }}</span>
        </div>  
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('user.store') }}" class="min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm space-y-4">
        @csrf

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Nama User</label>
            <input type="text" value="{{ old('nama') }}" name="nama" placeholder="Masukkan nama user.." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('nama')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Username</label>
            <input type="text" value="{{ old('username') }}" name="username" placeholder="Masukkan Username.." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('username')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror
        
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Password</label>
            <input type="password" value="{{ old('password') }}" name="password" placeholder="Masukkan Password.." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('password')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror
        
        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Masukkan Konfirmasi Password.." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('password_confirmation')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror
        
        <!-- Select -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Pilih Role</label>
            <select name="role_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
               @foreach ($roles as $role)
                    @if (old('role_id') == $role->id_role)
                        <option selected value="{{ $role->id_role }}" selected>{{$role->role}}</option>
                    @else
                        <option value="{{ $role->id_role }}">{{$role->role}}</option>\
                    @endif    
                @endforeach
            </select>
        </div>
        @error('role_id')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror

        <label class="text-sm font-medium text-gray-700 mt-5">Pilih Photo Profile</label>
        <div id="avatarWrapper" data-isrequired="false" class="size-20 group rounded-full overflow-hidden relative cursor-pointer">

            <div class="absolute inset-0 bg-black/40 flex items-center justify-center
                        opacity-0 group-hover:opacity-100 transition z-100">
                <i id="avatarIcon" class="bx bxs-pencil text-white text-xl"></i>
            </div>

            <input type="file" id="avatarInput" name="profil" accept="image/*" class="hidden">

            <img id="avatarPreview"
                data-defaultsrc="https://ui-avatars.com/api/?name=BookLoan&background=random&length=2"
                src="https://ui-avatars.com/api/?name=BookLoan&background=random&length=2"
                class="size-full rounded-full object-cover">
        </div>
        @error('profil')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-plus' ></i> Tambah
            </button>
        </div>

    </form>

    @vite('resources/js/image_previewer.js')
@endsection