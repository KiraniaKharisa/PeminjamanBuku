@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Edit Kategori  
@endsection

@section('container')
	<div class="title-container">
		<div>
			<h1 class="title">Edit Data Kategori</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="divider">/</li>
				<li><a href="{{ route('kategori.index') }}">Data Kategori</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Edit</a></li>
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

    <form method="POST" action="{{ route('kategori.update', $kategori->id_kategori) }}" class="min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm space-y-4">
        @method('PUT')
        @csrf

        <!-- Input Text -->
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" name="nama_kategori" placeholder="Masukkan nama kategori.." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
        </div>
        @error('nama_kategori')
            <p class="text-red-500 my-1">{{ $message }}</p>            
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-pencil' ></i> Edit
            </button>
        </div>

    </form>
@endsection