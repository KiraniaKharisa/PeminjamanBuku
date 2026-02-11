<nav>
	<span class="toggle-sidebar">
		<i class='bx bx-chevrons-left'></i>
	</span>
	<form action="{{ route('buku.home') }}">
		<div class="form-group">
			<input type="text" name="search" class="search-input-navbar" placeholder="Search...">
			<i class='bx bx-search icon hidden min-[550px]:block'></i>
			<i class='bx bx-search icon block min-[550px]:hidden' id="icon-toggle-input"></i>
		</div>
		<div class="form-group-melayang">
			<input type="text" name="search" class="search-input-navbar" placeholder="Search...">
			<i class='bx bx-search icon' ></i>
		</div>
	</form>
	{{-- <a href="#" class="nav-link">
		<i class='bx bxs-bell icon' ></i>
		<span class="badge">5</span>
	</a> --}}
	{{-- <span class="divider"></span> --}}
	<div class="profile">
		<span>{{ mb_strimwidth(auth()->user()->nama, 0, 7) }}</span>
		<img src="{{ auth()->user()->profil ? asset('storage/image/profil/' . auth()->user()->profil) : 'https://ui-avatars.com/api/?name='. preg_replace('/\s+/', '', auth()->user()->nama) . '&background=random&length=2'}}" alt="">
		<ul class="profile-link">
			<li>
				<a href="{{ route('edit_profil') }}">
					<span>
						<i class='bx bxs-user-circle icon' ></i> 
						Profil 
					</span>
					{{-- <span class="badge">9+</span> --}}
				</a>
			</li>
			{{-- <li class="block md:hidden">
				<a href="#">
					<span>
						<i class='bx bxs-bell icon' ></i> 
						Notifikasi 
					</span>
					<span class="badge">9+</span>
				</a>
			</li> --}}
			<li>
				<form action="{{ route('logout.post') }}" method="POST">
					@csrf
					<button type="submit" id="btn-delete" data-pesan="Apakah Anda Yakin Mau Keluar ?">
						<i class='bx bxs-door-open icon' ></i> 
						Keluar 
					</button>
				</form>
				{{-- <span class="badge">9+</span> --}}
			</li>
		</ul>
	</div>
</nav>

<script>
	document.querySelectorAll('.search-input-navbar').forEach((input) => {
		input.addEventListener('keydown', (e) => {
			if(e.key == "Enter") {
				window.location.href = `{{ route('buku.home') }}?search=${e.target.value}`
			}
		})
	})
</script>