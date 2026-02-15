@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Buat Data Kunjungan
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Buat Data Kunjungan</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="{{ route('kunjungan.index') }}">Data Kunjungan</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Tambah</a></li>
            </ul>
        </div>

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

    <form method="POST" enctype="multipart/form-data" action="{{ route('kunjungan.store') }}" class="min-w-[300px] w-full rounded-xl mt-5 bg-gray-50 p-4 shadow-sm space-y-4">
        @csrf
       <!--- Select Option User -->
        {{-- <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700">Pilih Pengguna</label>
            <select name="user_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach ($users as $user) 
                    @if(old('user_id') == $user->id_user)
                        <option value="{{ $user->id_user }}" selected>({{ $user->username }}) - {{ $user->nama }}</option>
                    @else  
                        <option value="{{ $user->id_user }}">({{ $user->username }}) - {{ $user->nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
         --}}
        <div class="w-full relative" id="dropdownWrapper">

            <!-- Input -->
            <input 
                type="text"
                id="searchInput"
                placeholder="Pilih user..."
                autocomplete="off"
                class="w-full px-4 py-2 border rounded-lg 
                    bg-white dark:bg-gray-800 
                    text-gray-700 dark:text-white
                    border-gray-300 dark:border-gray-600
                    focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >

            <!-- Hidden value -->
            <input type="hidden" name="user_id" id="selectedUser">

            <!-- Dropdown -->
            <div id="dropdownList"
                class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 
                        border border-gray-300 dark:border-gray-600 
                        rounded-lg shadow-lg max-h-60 overflow-y-auto hidden">

                @foreach($users as $user)
                    <div 
                        class="dropdown-item px-4 py-2 cursor-pointer 
                            hover:bg-blue-500 hover:text-white
                            text-gray-700 dark:text-gray-200"
                        data-id="{{ $user->id_user }}"
                    >
                        {{ $user->username }}
                    </div>
                     {{-- {{ $user->nama }} --}}
                @endforeach

            </div>
        </div>
        @error('user_id')
            <p class="text-red-500 my-1">{{ $message }}</p>
        @enderror

        <!-- Button (Left) -->
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                <i class='bx bx-plus' ></i> Tambah
            </button>
        </div>

    </form>


    <script>
    const input = document.getElementById('searchInput');
    const dropdown = document.getElementById('dropdownList');
    const hiddenInput = document.getElementById('selectedUser');
    const items = document.querySelectorAll('.dropdown-item');
    const wrapper = document.getElementById('dropdownWrapper');

    // Show dropdown saat focus
    input.addEventListener('focus', () => {
        dropdown.classList.remove('hidden');
    });

    // Filter saat mengetik
    input.addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        dropdown.classList.remove('hidden');

        items.forEach(item => {
            let text = item.innerText.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Select item
    items.forEach(item => {
        item.addEventListener('click', function () {
            input.value = this.innerText;
            hiddenInput.value = this.dataset.id;
            dropdown.classList.add('hidden');
        });
    });

    // Close jika klik luar
    document.addEventListener('click', function (e) {
        if (!wrapper.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
    </script>




@endsection