<footer class="footer-element">
    <div class="container-footer">
        <div class="content-utama">
            <div class="logo-desk">
                <a href="/" class="text-2xl flex items-center font-bold text-blue-500 z-[100] transition-all duration-300">
                    <i class='bx bx-library icon text-4xl'></i> BukuKita
                </a>
                <p>Buku Kita adalah platform peminjaman buku yang memudahkan pengguna mengakses dan meminjam koleksi bacaan secara praktis. Kami berkomitmen menghadirkan layanan peminjaman yang tertata, informatif, dan nyaman, mulai dari pengelolaan data buku, proses peminjaman, hingga pengembalian yang terjadwal dengan jelas.</p>
            </div>
            <div class="link-cepat">
                <h3>Link Cepat</h3>
                <a href="/">Beranda</a>
                <a href="/authentikasi">Masuk</a>
                <a href="/authentikasi">Daftar
                </a>
            </div>
            <div class="kategori-populer">
                <h3>Kategori Populer</h3>
                @foreach ($kategoriPopuler->take(5) as $kategori)
                    <a href="{{ route('buku.home') }}?kategori={{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</a>
                @endforeach
            </div>
            <div class="medsos-content">
                <h3>Sosial Media</h3>
                <div>
                    <a href="https://www.youtube.com/@fktech.nology" target="_blank"><i class='bx bxl-youtube' ></i></a>
                    <a href="https://www.tiktok.com/@fk_clippers" target="_blank"><i class='bx bxl-tiktok' ></i></a>
                    <a href="https://x.com/Fahmy_4you" target="_blank"><i class='bx bxl-twitter'></i></a>
                </div>
            </div>
        </div>
        <div class="container-contact">
            <a>
                <div><i class='bx bx-map'></i></div>
                <h5>Sidomekar Jember Jawa Timur</h5>
            </a>
            <a>
                <div><i class='bx bxs-phone'></i></div>
                <h5>(0036) 444 112</h5>
            </a>
            <a>
                <div><i class='bx bxs-envelope' ></i></div>
                <h5>Buku Kita@gmail.com</h5>
            </a>
            <a>
                <div><i class='bx bxl-whatsapp' ></i></div>
                <h5>+62 856 2213 2908</h5>
            </a>
        </div>
    </div>
    <div class="copyright-content">
        <h5>&copy; Buku Kita 2025 - Platform Peminjaman Buku</h5>
    </div>
</footer>  