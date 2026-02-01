@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Tambah Role 
@endsection

@section('container')
	<div class="title-container">
		<div>
			<h1 class="title">Buat Data Role</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="divider">/</li>
				<li><a href="{{ route('role.index') }}">Data Role</a></li>
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

    <form method="POST" action="{{ route('role.store') }}" class="min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm space-y-4">
        @csrf

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Nama Role</label>
            <input type="text" value="{{ old('role') }}" name="role" placeholder="Masukkan nama role.." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('role')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-plus' ></i> Tambah
            </button>
        </div>

    </form>
@endsection