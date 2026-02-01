<header class="navbar-element" data-section-scroll="true">
    <div class="content-nav">
        <div class="image">
            <a href="/" class="text-2xl gap-x-2 flex items-center font-bold text-blue-500 z-[100] transition-all duration-300">
                <i class='bx bx-library icon text-4xl'></i> BukuKita
            </a>
            </div>
            
        <ul>
            <li class="link-nav"><a href="#beranda">Beranda</a></li>
            <li class="link-nav"><a href="#buku_populer">Buku Populer</a></li>
            <li class="link-nav"><a href="#kategori_populer">Kategori Populer</a></li>
            <li class="link-nav"><a href="#tentang">Tentang Kami</a></li>
        </ul>
            
        @if (!auth()->check())
            <a href="{{ route('login') }}" class="koleksi_btn"><i class='bx bxs-door-open text-lg'></i> Masuk</a>
        @else
            <a href="{{ route('dashboard') }}" class="koleksi_btn"><i class='bx bxs-dashboard text-lg'></i> Dashboard</a>
        @endif
        
        <div class="hamburger-navbar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>
<div class="nav-link-mobile">
    <li class="link-nav"><a href="#beranda">Beranda</a></li>
    <li class="link-nav"><a href="#buku_populer">Buku Populer</a></li>
    <li class="link-nav"><a href="#kategori_populer">Kategori Populer</a></li>
    <li class="link-nav"><a href="#tentang">Tentang Kami</a></li>
    @if (!auth()->check())
        <li class="flex justify-center"><a href="{{ route('login') }}" class="koleksi_btn"><i class="bx bxs-door-open text-lg"></i> Masuk</a></li>
    @else
        <li class="flex justify-center"><a href="{{ route('dashboard') }}" class="koleksi_btn"><i class="bx bxs-dashboard text-lg"></i> Dashboard</a></li>
    @endif
</div>