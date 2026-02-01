<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::query();

        if ($request->filled('search')) {
            $query->where('id_transaksi', 'like', "%{$request->search}%");
        }

        match($request->order) {
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('created_at', 'asc')
        };

        match($request->status_filter) {
            'tertunda' => $query->where('status', 0),
            'dipinjam' => $query->where('status', 1)->whereDate('tanggal_kembali', '>', Carbon::now()),
            'terlambat' => $query->where('status', 1)->whereDate('tanggal_kembali', '<=', Carbon::now()),
            'dikembalikan' => $query->where('status', 2),
            'ditolak' => $query->where('status', 3),
            default => $query->where('status', 0),
        };
        
        $data = $query->get();
        return view('dashboard.transaksi.index', [
            'transaksis' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        $buku = Buku::all();

        return view('dashboard.transaksi.create', [
            'user' => $user,
            'buku' => $buku
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $buku = Buku::where('id_buku', $request->buku_id)->firstOrFail();

        $validate = $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'user_id' => 'required|exists:user,id_user',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'total_pinjam' => 'required|integer|min:1',
            'status' => 'required|in:0,1,2,3'
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
            Transaksi::create($validate);

            return redirect()->route('transaksi.index')->with('sukses', 'Data Transaksi berhasil ditambahkan!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Transaksi gagal ditambahkan!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('dashboard.transaksi.detail', [
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        if($transaksi->status != 0) {
            abort(403, 'Data Transaksi Ini Statusnya Sudah Bukan Ditunda, tidak dapat diubah.');
        }
        $user = User::all();
        $buku = Buku::all();

        return view('dashboard.transaksi.edit', [
            'transaksi' => $transaksi,
            'user' => $user,
            'buku' => $buku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        if($transaksi->status != 0) {
            abort(403, 'Data Transaksi Ini Statusnya Sudah Bukan Ditunda, tidak dapat diubah.');
        }
        $buku = Buku::where('id_buku', $request->buku_id)->firstOrFail();

        $validate = $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'user_id' => 'required|exists:user,id_user',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'total_pinjam' => 'required|integer|min:1',
            'status' => 'required|in:0,1,2,3'
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
           $transaksi->update($validate);

            return redirect()->route('transaksi.index')->with('sukses', 'Data Transaksi berhasil diubah!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Transaksi gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteData = Transaksi::findOrFail($id);
            $deleteData->delete();

            return redirect()->route('transaksi.index')->with('sukses', 'Data Transaksi berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('transaksi.index')->with('error', 'Data Transaksi gagal dihapus!');
        }

    }

    public function edit_status(Request $request, string $id, string $status) {
        $gagalTransaksi = null;

        try {
            DB::transaction(function () use ($id, $status, &$gagalTransaksi) {

                // Lock transaksi
                $transaksi = Transaksi::lockForUpdate()->findOrFail($id);

                // Lock buku
                $buku = Buku::lockForUpdate()->findOrFail($transaksi->buku_id);

                $statusQuery = null;

                // Kondisi Status Pending
                if ($transaksi->status == 0) {

                    // Jika tanggal kembali sudah lewat → auto tolak
                    if ($transaksi->tanggal_kembali < Carbon::today()->toDateString()) {
                        $transaksi->update(['status' => 3]);
                        $gagalTransaksi = "Transaksi otomatis diubah ke ditolak karena tanggal kembali sudah lewat";
                        return;
                    }

                    // Kondisi Ketika Disetujui Transaksi
                    if ($status === 'disetujui') {

                        // Cek stok jika stok kurang maka kirim pesan error
                        if ($transaksi->total_pinjam > $buku->stok) {
                            throw new \Exception('STOK_KURANG');
                        }

                        //  Kurangi stok
                        $buku->stok -= $transaksi->total_pinjam;
                        $buku->save();

                        $statusQuery = 1;

                    // Kondisi Ketika Di Tolak
                    } elseif ($status === 'ditolak') {
                        $statusQuery = 3;

                    // Jika Selain Transaksi Diatas Maka Kirimkan Pesan Error Invalid Pending    
                    } else {
                        throw new \Exception('INVALID_STATUS_PENDING');
                    }

                // Kondisi Ketika Transaksinya Sama Dengan 1 Atau Dipinjamm
                } elseif ($transaksi->status == 1) {

                    // Kondisi Ketika Dia Mau Merubah Status Dikembalikan
                    if ($status === 'dikembalikan') {

                        // Kembalikan stok
                        $buku->stok += $transaksi->total_pinjam;
                        $buku->save();

                        $statusQuery = 2;

                    // Jika Statusnya Selain Diatas Maka Kirim Pesan Error
                    } else {
                        throw new \Exception('INVALID_STATUS_SETUJU');
                    }

                // Ketika Transaksinya Status Ditolak
                } elseif ($transaksi->status == 3) {

                    // Ketika Mau Melakukan Pemulihan Tapi Tanggal Kembalinya Sudah Lewat Maka Gagalkan Perubahan Transaksi
                    if ($transaksi->tanggal_kembali <= Carbon::today()->toDateString()) {
                        throw new \Exception('EXPIRED');
                    }

                    // Kondisi Pemulihan Status Dari Tolak Ke Pending
                    if ($status === 'dipulihkan') {
                        $statusQuery = 0;

                    // Jika perubahan status selain diatas maka kembalikan pesan error
                    } else {
                        throw new \Exception('INVALID_STATUS_TOLAK');
                    }

                // Jika Statusnya selain diatas maka berikan error status tidak diketahui
                } else {
                    throw new \Exception('UNKNOWN_STATUS');
                }

                // 🔄 Update status
                $transaksi->update(['status' => $statusQuery]);
            });

            if(!empty($gagalTransaksi)) {
                return redirect()->back()->with('error', $gagalTransaksi);
            }

            return redirect()->back()->with('sukses', 'Status berhasil diperbarui menjadi ' . $status);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', match ($e->getMessage()) {
                'INVALID_STATUS_PENDING' => 'Hanya bisa mengajukan Disetujui atau Ditolak',
                'INVALID_STATUS_SETUJU' => 'Hanya bisa mengajukan Dikembalikan',
                'INVALID_STATUS_TOLAK' => 'Hanya bisa mengajukan Dipulihkan',
                'STOK_KURANG' => 'Stok buku tidak mencukupi',
                'AUTO_TOLAK' => 'Transaksi ditolak karena tanggal kembali sudah lewat',
                'UNKNOWN_STATUS' => 'Gagal mengubah status, status tidak diketahui',
                default => 'Gagal Mengubah Status, Terjadi Error'
            });
        }
    }
}
