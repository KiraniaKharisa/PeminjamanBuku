@extends('dashboard.layouts.main')

@section('title') 
  Dashboard Admin | Edit Profil
@endsection

@section('container')
    <div class="title-container">
        <div>
            <h1 class="title">Edit Profil</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Profil</a></li>
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
  @error('profil')
      <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
          <i class='bx bx-x-circle text-lg'></i>
          <span>{{ $message }}</span>
      </div>
  @enderror
  @error('hapus_profil')
      <div class="flex mt-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
          <i class='bx bx-x-circle text-lg'></i>
          <span>{{ $message }}</span>
      </div>
  @enderror

    <div class="flex flex-col min-[1000px]:flex-row justify-center my-5 gap-5 h-[620px] min-[1000px]:h-[352px]">
        <div class="bg-gray-50 shadow w-full min-[1000px]:w-[40%] min-w-[300px] flex flex-col items-center p-5 rounded-lg">
            <form id="avatarWrapper" data-isrequired="false" class="size-30 group rounded-full overflow-hidden relative cursor-pointer">

                <div class="absolute inset-0 bg-black/40 flex items-center justify-center
                            opacity-0 group-hover:opacity-100 transition z-100">
                    <i id="avatarIcon" class="bx bxs-pencil text-white text-xl"></i>
                </div>

                <input type="file" id="avatarInput" name="profil" accept="image/*" class="hidden">

                <img id="avatarPreview"
                    data-defaultsrc="https://ui-avatars.com/api/?name={{ preg_replace('/\s+/', '', $user->nama) }}&background=random&length=2"
                    src="{{ $user->profil ? asset('storage/image/profil/' . $user->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', $user->nama) . '&background=random&length=2'}}"
                    class="size-full rounded-full object-cover">
            </form>
            <h1 class="font-bold text-[18px] mt-5">{{ $user->nama }}</h1>
            <h3 class="text-md text-gray-400">{{ $user->username }}</h3>
        </div>
        <div class="flex-1">
          <div class="w-full shadow flex relative overflow-hidden justify-around p-2 bg-gray-50 rounded-full">
            <button id="informasiPribadiBtn" class="font-semibold tracking-wider text-sm cursor-pointer w-1/2">Informasi Pribadi</button>
            <button id="editPasswordBtn" class="font-semibold tracking-wider text-sm cursor-pointer w-1/2">Edit Password</button>
            <div id="indicator" class="absolute bottom-0 left-0 w-1/2 h-[3px] bg-blue-600 rounded-full transition-all duration-700 {{ session()->has('password_edit') ? 'translate-x-full' : 'translate-x-0' }}"></div>
          </div>

          <form action="{{ route('edit_profil.post') }}" enctype="multipart/form-data" method="POST" id="informasiForm" class="w-full shadow rounded-lg bg-gray-50 flex flex-col mt-5 p-5 gap-y-3 {{ session()->has('password_edit') ? 'hidden' : '' }}">
            @method('PUT')
            @csrf
            <!-- Input Text -->
            <div class="-mt-1">
                <label class="text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Masukkan nama..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
                @error('nama')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Input Text -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Masukkan username" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
                @error('username')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Button (Left) -->
            <div class="flex justify-end">
                <button type="submit" id="btn_edit_profil" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                    <i class='bx bxs-pencil' ></i> Edit Profil
                </button>
            </div>
          </form>

          <form action="{{ route('edit_password') }}" method="POST" id="passwordForm" class="w-full shadow rounded-lg bg-gray-50 flex flex-col mt-5 p-5 gap-y-3 {{ session()->has('password_edit') ? '' : 'hidden' }}">
            @method('PUT')
            @csrf
            <!-- Input Text -->
            <div class="-mt-1">
                <label class="text-sm font-medium text-gray-700">Password Lama</label>
                <input type="password" name="password_lama" placeholder="Masukkan password lama..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
                @error('password_lama')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Input Text -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" placeholder="Masukkan password baru..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Input Text -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Masukkan konfirmasi password..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"/>
                @error('password_confirmation')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Button (Left) -->
            <div class="flex justify-end">
                <button type="submit" class="rounded-lg bg-blue-500 px-5 py-2 text-sm font-medium text-white hover:bg-blue-600 flex items-center gap-2">
                    <i class='bx bx-key' ></i> Edit Password
                </button>
            </div>
          </form>

        </div>
    </div>

    @vite(['resources/js/image_previewer.js', 'resources/js/edit_profil.js'])

    <script>
        const form = document.querySelector('#informasiForm');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const inputFileAvatar = document.querySelector('#avatarInput');
            const inputHapus = document.querySelector('#inputHapus');

            const inputFile = document.createElement('input');
            inputFile.type = 'file';
            inputFile.style.display = 'none';
            inputFile.name = 'profil';

            const inputHapusProfil = document.createElement('input');
            inputHapusProfil.type = 'hidden';
            inputHapusProfil.name = 'hapus_profil';
            inputHapusProfil.value = inputHapus.value;

            if (inputFileAvatar.files.length) {
                const file = inputFileAvatar.files[0];
                const dt = new DataTransfer();
                dt.items.add(file);

                inputFile.files = dt.files;
            }

            form.appendChild(inputFile);
            form.appendChild(inputHapusProfil);
            form.submit();
        })

    </script>
@endsection