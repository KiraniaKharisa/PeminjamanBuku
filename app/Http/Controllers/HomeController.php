<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Buku_Favorit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $totalBuku = Buku::count();
        $totalTransaksi = Transaksi::count();
        $totalKategori = Kategori::count();
        $totalUser = User::count();

        $bukuPopuler = Buku::withCount([
            'transaksi as total_pinjam' => function ($query) {
                $query->where('status', 1);
            }
        ])->orderByDesc('total_pinjam')->limit(8)->get();

        $kategori = Kategori::withCount('buku')
                            ->orderByDesc('buku_count');

        $kategoriPopulerTotal30 = $kategori->limit(30)->get();
        $kategoriPopuler = $kategori->limit(6)->get();
        
        return view('home.landing', [
            'totalBuku' => $totalBuku,
            'totalTransaksi' => $totalTransaksi,
            'totalUser' => $totalUser,
            'totalKategori' => $totalKategori,
            'kategoriPopuler' => $kategoriPopuler,
            'bukuPopuler' => $bukuPopuler,
            'kategoriPopulerTotal30' => $kategoriPopulerTotal30
        ]);
    }

    public function buku(Request $request) {
        $query = Buku::query();

        if($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul_buku', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_buku', 'like', '%' . $request->search . '%');
            });
        }

        if($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $buku = $query->get();
        $kategori =  Kategori::withCount('buku')->get();
        $kategoriPopuler = Kategori::limit(6)->get();

        return view('home.buku.index', [
            'buku' => $buku,
            'kategori' => $kategori,
            'kategoriPopuler' => $kategoriPopuler
        ]);
    }

    public function kategori(Request $request) {
        $query = Kategori::query();

        if($request->has('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->get();
        $kategoriPopuler = Kategori::limit(6)->get();

        return view('home.kategori.index', [
            'kategori' => $kategori,
            'kategoriPopuler' => $kategoriPopuler
        ]);
    }

    public function buku_detail($id) {
        $buku = Buku::findOrFail($id);
        $transaksi = Transaksi::where('buku_id', $id)
                                ->where('status', 1)
                                ->get();

        $isFavorit = false;
        if(auth()->check()){
            $isFavorit = Buku_Favorit::where('user_id', auth()->user()->id_user)
                                  ->where('buku_id', $buku->id_buku)
                                  ->exists();
        }
        $kategoriPopuler = Kategori::limit(6)->get();

        return view('home.buku.detail', [
            'buku' => $buku,
            'transaksi' => $transaksi,
            'isFavorit' => $isFavorit,
            'kategoriPopuler' => $kategoriPopuler
        ]);
    }

    
}
