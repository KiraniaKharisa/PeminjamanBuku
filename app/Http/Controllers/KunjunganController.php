<?php

namespace App\Http\Controllers;

use App\Exports\KunjunganExport;
use App\Models\Kunjungan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KunjunganController extends Controller
{
    // ==============================
    // 1. USER ISI KUNJUNGAN
    // ==============================
    public function store(Request $request)
    {
        $today = now()->toDateString();
        $validate = $request->validate([
            'user_id' => 'required|exists:user,id_user'
        ]);


        $cek = Kunjungan::where('user_id', $validate['user_id'])
            ->whereDate('tanggal', $today)
            ->exists();

        if ($cek) {
            return back()->with('error', 'User sudah mengisi kunjungan hari ini.');
        }

        Kunjungan::create([
            'user_id' => $validate['user_id'],
            'tanggal' => $today,
        ]);

        return redirect()->route('kunjungan.index')->with('sukses', 'Kunjungan berhasil dicatat.');
    }

    // ==============================
    // 2. ADMIN LIHAT DATA KUNJUNGAN
    // ==============================
    public function index(Request $request)
    {
        $query = Kunjungan::with('user');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                });
            });
        }

        return view('dashboard.kunjungan.index', [
            'data' => $query->latest()->get()
        ]);
    }

    public function create()
    {
        $data = User::all();

        return view('dashboard.kunjungan.create', [
            'users' => $data
        ]);
    }

    // ==============================
    // 3. EXPORT EXCEL
    // ==============================
    public function export()
    {
        return Excel::download(new KunjunganExport, 'laporan-kunjungan.xlsx');
    }

}
