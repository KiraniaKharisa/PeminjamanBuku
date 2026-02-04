<header class="navbar-element">
    <div class="content-nav">
        <div class="image">
            <a href="/" class="text-2xl gap-x-2 flex items-center font-bold text-blue-500 z-[100] transition-all duration-300">
                <i class='bx bx-library icon text-4xl'></i> BukuKita
            </a>
            </div>
            
        <ul>
            @if (!auth()->check())
                <li class="link-nav"><a href="{{ route('home') }}">Beranda</a></li>
            @endif
            <li class="link-nav {{ request()->is('buku') || request()->is('buku/*') ? 'active' : '' }}"><a href="{{ route('buku.home') }}">Buku Populer</a></li>
            <li class="link-nav {{ request()->is('kategori') ? 'active' : '' }}"><a href="{{ route('kategori.home') }}">Kategori Populer</a></li>
        </ul>
            
        @if (!auth()->check())
            <a href="{{ route('login') }}" class="koleksi_btn"><i class='bx bxs-door-open text-lg'></i> Masuk</a>
        @else
            {{-- <a href="{{ route('dashboard') }}" class="koleksi_btn"><i class='bx bxs-dashboard text-lg'></i> Dashboard</a> --}}
            
            <a href="{{ route('dashboard') }}" class="hidden xl:flex items-center justify-center text-sm gap-x-2 flex-row-reverse bg-gray-200 px-3 py-1 rounded-full"><img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" class="size-8 rounded-full object-cover" alt=""> {{ mb_strimwidth(auth()->user()->nama, 0, 7) }}</a>
        @endif
            
        <div class="hamburger-navbar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>
<div class="nav-link-mobile">
    @if (!auth()->check())
        <li class="link-nav"><a href="{{ route('home') }}">Beranda</a></li>
    @endif
    <li class="link-nav"><a href="{{ route('buku.home') }}">Buku Populer</a></li>
    <li class="link-nav"><a href="{{ route('kategori.home') }}">Kategori Populer</a></li>
   @if (!auth()->check())
        <li class="flex justify-center"><a href="{{ route('login') }}" class="koleksi_btn"><i class="bx bxs-door-open text-lg"></i> Masuk</a></li>
    @else
        {{-- <li class="flex justify-center"><a href="{{ route('dashboard') }}" class="koleksi_btn"><i class="bx bxs-dashboard text-lg"></i> Dashboard</a></li> --}}


        <li class="flex justify-center"><a href="{{ route('dashboard') }}" class="flex items-center justify-center text-sm gap-x-2 flex-row-reverse bg-gray-200 px-3 py-1 rounded-full"><img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" class="size-8 rounded-full object-cover" alt=""> {{ mb_strimwidth(auth()->user()->nama, 0, 7) }}</a></li>
    @endif
</div>