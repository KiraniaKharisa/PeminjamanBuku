<section id="sidebar">
	<a href="#" class="brand"><i class='bx bx-library icon'></i> BukuKita</a>
	
	<ul class="side-menu">
		<li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
		<li><a href="{{ route('edit_profil') }}" class="{{ request()->is('dashboard/editprofil') ? 'active' : '' }}"><i class='bx bxs-user icon' ></i> Profil</a></li>
		<li><a href="{{ route('riwayat') }}" class="{{ request()->is('dashboard/riwayat') ? 'active' : '' }}"><i class='bx bxs-time icon' ></i> Riwayat</a></li>
		<li><a href="{{ route('favorit') }}" class="{{ request()->is('dashboard/favorit') ? 'active' : '' }}"><i class='bx bxs-bookmarks icon' ></i> Favorit</a></li>
		
		@can('admin')
			<li class="divider" data-text="ADMIN">ADMIN</li>
			<li>
				<a href="#" class="{{ request()->is('dashboard/buku*') || request()->is('dashboard/kategori*') ? 'active' : '' }}"><i class='bx bxs-book icon' ></i> Katalog <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown {{ request()->is('dashboard/buku*') || request()->is('dashboard/kategori*') ? 'show' : '' }}">
					<li><a href="{{ route('buku.index') }}" class="{{ request()->is('dashboard/buku*') ? 'active' : '' }}">Buku</a></li>
					<li><a href="{{ route('kategori.index') }}" class="{{ request()->is('dashboard/kategori*') ? 'active' : '' }}">Kategori</a></li>
				</ul>
			</li>
			<li>
				<a href="#" class="{{ request()->is('dashboard/role*') || request()->is('dashboard/user*') ? 'active' : '' }}"><i class='bx bxs-user-detail icon' ></i> Keanggotaan <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown {{ request()->is('dashboard/role*') || request()->is('dashboard/user*') ? 'show' : '' }}">
					{{-- <li><a href="{{ route('role.index') }}" class="{{ request()->is('dashboard/role*') ? 'active' : '' }}">Hak Akses</a></li> --}}
					<li><a href="{{ route('user.index') }}" class="{{ request()->is('dashboard/user*') ? 'active' : '' }}">Pengguna</a></li>
					<li><a href="{{ route('aktifasi') }}" class="{{ request()->is('dashboard/user/aktifasi*') ? 'active' : '' }}">Aktifasi</a></li>
				</ul>
			</li>
			<li><a href="{{ route('transaksi.index') }}" class="{{ request()->is('dashboard/transaksi*') ? 'active' : '' }}"><i class='bx bx-spreadsheet icon'></i> Transaksi</a></li>
		@endcan

		<div class="mt-auto">
			<li class="mt-5"><a href="{{ route('buku.home') }}"><i class='bx bxs-home icon' ></i> Kembali</a></li>
			<li id="toggle-sidebar-2"><a><i class='bx bx-collapse icon' ></i> <span>Perkecil</span></a></li>
		</div>
	</ul>
</section>


{{-- <section id="sidebar">
	<a href="#" class="brand"><i class='bx bx-library icon'></i> BukuKita</a>
	<ul class="side-menu">
		<li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
		<li><a href="{{ route('edit_profil') }}" class="{{ request()->is('dashboard/editprofil') ? 'active' : '' }}"><i class='bx bxs-user icon' ></i> Profil</a></li>
		
		@can('admin')
		<li class="divider" data-text="Pustakawan">Pustakawan</li>
		<li><a href="{{ route('user.index') }}" class="{{ request()->is('dashboard/user*') ? 'active' : '' }}"><i class='bx bxs-user-account icon'></i> Pengguna</a></li>
		<li><a href="{{ route('role.index') }}" class="{{ request()->is('dashboard/role*') ? 'active' : '' }}"><i class='bx bx-accessibility icon'></i> Hak Akses</a></li>
		<li><a href="{{ route('buku.index') }}" class="{{ request()->is('dashboard/buku*') ? 'active' : '' }}"><i class='bx bxs-book icon'></i> Buku</a></li>
		<li><a href="{{ route('kategori.index') }}" class="{{ request()->is('dashboard/kategori*') ? 'active' : '' }}"><i class='bx bxs-category-alt icon'></i> Kategori</a></li>
		<li><a href="{{ route('transaksi.index') }}" class="{{ request()->is('dashboard/transaksi*') ? 'active' : '' }}"><i class='bx bxs-bookmarks icon'></i> Transaksi</a></li>
		@endcan
		
		<div class="mt-auto">
			<li><a href="{{ route('home') }}" ><i class='bx bxs-home icon' ></i>Kembali</a></li>
			<li id="toggle-sidebar-2"><a><i class='bx bx-collapse icon' ></i> <span>Perkecil</span></a></li>
		</div>
	</ul>
</section> --}}