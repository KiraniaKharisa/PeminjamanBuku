<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Buku_Favorit;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Kunjungan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    protected $imageHelper;
    protected $profilPath = 'image/profil/';

    public function __construct(ImageHelper $imageHelper) {
        $this->imageHelper = $imageHelper;
    }
    
    public function index() {
        $jam = Carbon::now()->hour;
        $tahun = Carbon::now()->year;

        $dataMentah = DB::table('transaksi')
                        ->selectRaw('MONTH(created_at) as bulan,status,tanggal_kembali,COUNT(*) as total')
                        ->whereYear('created_at', $tahun)
                        ->groupBy('bulan', 'status', 'tanggal_kembali')
                        ->get();

        $bulanTransaksi = [
            'Ditunda' => array_fill(0, 12, 0),
            'Dipinjam' => array_fill(0, 12, 0),
            'Telat' => array_fill(0, 12, 0),
            'Kembali' => array_fill(0, 12, 0),
            'Ditolak' => array_fill(0, 12, 0),
        ];

        $hariIni = Carbon::today();
        foreach($dataMentah as $data) {
            $index = $data->bulan - 1;

            // Jika statusnya 1 dan tanggal kembali lewat dari hari ini maka dia dianggap data telat
            if($data->status == 1 && Carbon::parse($data->tanggal_kembali)->lt($hariIni)) {
                $bulanTransaksi['Telat'][$index] += $data->total;
                continue;
            }

            match($data->status) {
                0 => $bulanTransaksi['Ditunda'][$index] += $data->total,
                1 => $bulanTransaksi['Dipinjam'][$index] += $data->total,
                2 => $bulanTransaksi['Kembali'][$index] += $data->total,
                3 => $bulanTransaksi['Ditolak'][$index] += $data->total,
                default => null,
            };
        }

        $tahun = date('Y');

        $data = Kunjungan::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tanggal', $tahun)
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total','bulan')
            ->toArray();

        // Buat array 12 bulan default 0
        $totalKunjungan = [];

        for ($i = 1; $i <= 12; $i++) {
            $totalKunjungan[] = $data[$i] ?? 0;
        }

        $salam = '';
        if ($jam >= 5 && $jam < 11) {
            $salam = 'Pagi';
        } elseif ($jam >= 11 && $jam < 15) {
            $salam = 'Siang';
        } elseif ($jam >= 15 && $jam < 18) {
            $salam = 'Sore';
        } else {
            $salam = 'Malam';
        }

        $transaksiKu = Transaksi::where('user_id', auth()->user()->id_user)
                                    ->where('status', 1)
                                    ->get();

        $bukuPopuler = Buku::withCount([
            'transaksi as total_pinjam' => function($query) {
                $query->where('status', 1);
            }
        ])->orderByDesc('total_pinjam')->limit(4)->get();

        $kategoriPopuler = Kategori::withCount('buku')
                            ->orderByDesc('buku_count')->limit(5)->get();

        $totalBuku = Buku::count();
        $totalTransaksi = Transaksi::count();
        $totalUser = User::count();
        $totalKategori = Kategori::count();

        return view('dashboard.index', [
            'totalBuku' => $totalBuku,
            'totalTransaksi' => $totalTransaksi,
            'totalUser' => $totalUser,
            'totalKategori' => $totalKategori,
            'salam' => $salam,
            'bulanTransaksi' => $bulanTransaksi,
            'transaksiKu' => $transaksiKu,
            'bukuPopuler' => $bukuPopuler,
            'kategoriPopuler' => $kategoriPopuler,
            'totalKunjungan' => $totalKunjungan,
        ]);
    }

    public function edit_profil() {
        $user = User::findOrFail(auth()->user()->id_user);
        return view('dashboard.edit_profil', [
            'user' => $user
        ]);
    }

    public function edit_profil_post(Request $request) {
        $id = auth()->user()->id_user;
        $validate = $request->validate([
            'nama' => 'required|min:2',
            'username' => "required|min:3|unique:user,username,$id,id_user",
            'profil' => 'nullable|image|mimes:jpg,png,jpeg|max:3072', // Max 3MB
            'hapus_profil' => 'required|in:true,false'
        ]);

        
        try {
            $user = User::findOrFail($id);
            $profil = $user->profil;
            if($validate['hapus_profil'] == "true")  {
                if($profil != null) {
                    $imageLama = $this->profilPath . $profil;
                    $this->imageHelper->deleteImage($imageLama);
                }

                $profil = null;
            }

            if($request->hasFile('profil')) {
                $file = $request->file('profil');

                if($profil != null) {
                    $profil = $this->imageHelper->uploadImage($file, $this->profilPath, $profil);
                } else {
                    $profil = $this->imageHelper->uploadImage($file, $this->profilPath);
                }
            }

            $validate['profil'] = $profil;

            $user->update($validate);

            return redirect()->route('edit_profil')->with('sukses', 'Berhasil Mengedit Data Profil');
        } catch(Exception $e) {

            return redirect()->back()->with('error', 'Gagal Mengedit Data Profil');
        }
    }

    public function edit_password(Request $request) {
        $request->session()->flash('password_edit', true);

        $validate = $request->validate([
            'password_lama' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        

        try {
            $id = auth()->user()->id_user;
            $user = User::findOrFail($id);

            if(!Hash::check($validate['password_lama'], $user->password)) {
                return redirect()->route('edit_profil')
                                ->withErrors(['password_lama' => 'Password Lama Tidak Sesuai'])
                                ->withInput();
            }
            
            $password = Hash::make($validate['password']);
            $user->update(['password' => $password]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('sukses', 'Berhasil Mengedit Password');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengedit Password');
        }

    }

    public function pinjam(Request $request) {
        $buku = Buku::where('id_buku', $request->buku_id)->firstOrFail();

        $validate = $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'total_pinjam' => 'required|integer|min:1',
        ]);

        // Total Pinjam Tidak Boleh Lebih Dari Jumlah Stok Sekarang
        if($request->total_pinjam > $buku->stok) {
            return back()->withErrors([
                'total_pinjam' => 'Total Pinjam melebihi stok buku saat ini.'
            ])->withInput();
        }

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);

        if($tanggalKembali->gt($tanggalPinjam->copy()->addYear())) {
            return back()->withErrors([
                'tanggal_kembali' => 'Tanggal kembali maksimal 1 tahun dari tanggal pinjam'
            ])->withInput();
        }

        try {
            $validate['user_id'] = auth()->user()->id_user;
            $validate['buku_id'] = $buku->id_buku;
            $validate['status'] = 0; // Pending Otomatis

            Transaksi::create($validate);
            return redirect()->back()->with('sukses', 'Berhasil Menambahkan Data Transaksi');
        } catch(Exception $e) {

            return redirect()->back()->with('error', 'Gagal Menambahkan Data Transaksi');
        }
    }

    public function riwayat(Request $request) {
        $query = Transaksi::with('buku');

        if ($request->filled('search')) {
            $query->where('id_transaksi', 'like', "%$request->search%");
        }

        $transaksiPerBulan = $query->where('user_id', auth()->user()->id_user)
                                                ->whereIn('status', [1,2])
                                                ->orderByDesc('created_at')
                                                ->get()
                                                ->groupBy(function ($item) {
                                                    return $item->created_at->format('Y-m');
                                                })
                                                ->map(function ($items, $bulan) {
                                                    return [
                                                        'label' => Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y'),
                                                        'items' => $items
                                                    ];
                                                });

        return view('dashboard.riwayat', [
            'transaksiPerBulan' => $transaksiPerBulan
        ]);
    }

    public function favorit(Request $request) {
        $bukuFavorit = Buku_Favorit::where('user_id', auth()->user()->id_user);

        if($request->filled('search')) {
            $bukuFavorit->whereHas('buku', function($q) use ($request) {
                $q->where('judul_buku', 'like', "%$request->search%");
            });
        }

        $bukuFavorit = $bukuFavorit->get();

        return view('dashboard.favorit', [
            'bukuFavorit' => $bukuFavorit
        ]);
    }

    public function favorit_togle(Request $request, string $id) {
        $userId = auth()->user()->id_user;

        $favorit = Buku_Favorit::where('user_id', $userId)
                                    ->where('buku_id', $id)
                                    ->first();
        
        if($favorit) {
            $favorit->delete();

        } else {
            Buku_Favorit::create([
                'user_id' => $userId,
                'buku_id' => $id
            ]);
        }

        return redirect()->back();
    }

    public function favorit_delete(string $id) {
        try {
            $favorit = Buku_Favorit::findOrFail($id);

            $favorit->delete();

            return redirect()->route('favorit')->with('sukses', 'Berhasil Menghapus Data Favorit');
        } catch(Exception $e) { 

            return redirect()->route('favorit')->with('error', 'Gagal Menghapus Data Favorit');
        }
    }

    
    public function pengembalian(Request $request) {
        $query = Transaksi::with('buku');

        if ($request->filled('search')) {
            $query->where('id_transaksi', 'like', "%$request->search%");
        }

        $transaksiPerBulan = $query->where('user_id', auth()->user()->id_user)
                                                ->where('status', 1)
                                                ->orderByDesc('created_at')
                                                ->get()
                                                ->groupBy(function ($item) {
                                                    return $item->created_at->format('Y-m');
                                                })
                                                ->map(function ($items, $bulan) {
                                                    return [
                                                        'label' => Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y'),
                                                        'items' => $items
                                                    ];
                                                });

        return view('dashboard.pengembalian', [
            'transaksiPerBulan' => $transaksiPerBulan
        ]);
    }

    public function pengembalian_update(Request $request) {

        if(!$request->jumlah_pengajuan || !$request->id_transaksi) {
            return redirect()->back()->with('error', 'Jumlah pengajuan dan id transaksi tidak boleh kosong');
        }

        $transaksi = Transaksi::find($request->id_transaksi);
        

        if($transaksi == null) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if($request->jumlah_pengajuan > $transaksi->pinjamanSaatIni) {
            return redirect()->back()->with('error', 'Pengajuan tidak boleh lebih dari pinjaman saat ini');
        }

        $transaksi->update(['ajukan_pengembalian' => true, 'jumlah_pengajuan' => $request->jumlah_pengajuan]);

        return $request->session()->flash('sukses', 'Berhasil mengajukan pengembalian');
    }

    public function batalkan_pengajuan(string $id) {
        $transaksi = Transaksi::findOrFail($id);

        try {
            if($transaksi->ajukan_pengembalian == 0) {
                return redirect()->back()->with('error', 'Transaksi ini belum diajukan pengembalian');
            }

            $transaksi->update(['ajukan_pengembalian' => false, 'jumlah_pengajuan' => 0]);
            return redirect()->back()->with('sukses', 'Berhasil membatalkan pengajuan');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan pengajuan');
        }
    }

}
