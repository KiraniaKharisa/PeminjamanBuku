<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::query();

        if($request->filled('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        match($request->order) {
            'asc' => $query->orderBy('nama_kategori', 'asc'),
            'desc' => $query->orderBy('nama_kategori', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('nama_kategori', 'asc')
        };

        $data = $query->get();

        return view('dashboard.kategori.index', [
            'kategoris' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|min:2|unique:kategori,nama_kategori',
        ]);

        try{
            $createData = Kategori::create($validate);

            return redirect()->route('kategori.index')->with('sukses', 'Data Kategori berhasil ditambahkan!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Kategori gagal ditambahkan!');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('dashboard.kategori.detail', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('dashboard.kategori.edit', [
            'kategori' => $kategori
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|min:2|unique:kategori,nama_kategori,'. $id . ',id_kategori',
        ]);

        try{
            $editData = Kategori::findOrFail($id);
            $editData->update($validate);

            return redirect()->route('kategori.index')->with('sukses', 'Data Kategori berhasil diubah!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Kategori gagal diubah!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try {
            $deleteData = Kategori::findOrFail($id);
            $deleteData->delete();

            return redirect()->route('kategori.index')->with('sukses', 'Data Kategori berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('kategori.index')->with('error', 'Data Kategori gagal dihapus!');
        }

    }
}
