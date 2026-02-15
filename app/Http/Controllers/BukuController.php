<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Helper\ImageHelper;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    protected $imageHelper;
    protected $sampulPath = 'image/sampul/';
     
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Buku::query();

        if($request->filled('search')) {
            $query->where('judul_buku', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_buku', 'like', '%' . $request->search . '%');
        }

        match($request->order) {
            'asc' => $query->orderBy('judul_buku', 'asc'),
            'desc' => $query->orderBy('judul_buku', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('judul_buku', 'asc')
        };
        
        $data = $query->get();
        return view('dashboard.buku.index', [
            'books' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Kategori::all();

        return view('dashboard.buku.create', [
            'kategoris' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_buku' => 'required|min:3|unique:buku,kode_buku',
            'judul_buku' => 'required|min:3',
            'penulis' => 'required|min:3',
            'penerbit' => 'required|min:3',
            'tanggal_terbit' => 'required|date',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'sampul' => 'required|image|mimes:jpg,jpeg,png|max:3072', //max 3mb
            'deskripsi' => 'required|min:100'

        ]);

        try {
            $file = null;
            if($request->hasFile('sampul')) {
                $file = $request->file('sampul');
                $file = $this->imageHelper->uploadImage($file, $this->sampulPath);
            }

            $validate['sampul'] = $file;
            $createData = Buku::create($validate);

            return redirect()->route('buku.index')->with('sukses', 'Berhasil Menambahkan Data Buku');
        } catch(Exception $e) {

            return redirect()->back()->with('error', 'Gagal Menambahkan Data Buku');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);

        return view('dashboard.buku.detail', [
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Kategori::all();
        $buku = Buku::findOrFail($id);

        return view('dashboard.buku.edit', [
            'kategoris' => $data,
            'buku' => $buku
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'kode_buku' => "required|min:3|unique:buku,kode_buku,$id,id_buku",
            'judul_buku' => 'required|min:3',
            'penulis' => 'required|min:3',
            'penerbit' => 'required|min:3',
            'tanggal_terbit' => 'required|date',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'sampul' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:3072', //max 3mb
            'deskripsi' => 'required|min:100'
        ]);

        try {
            $buku = Buku::findOrFail($id);
            $sampul = $buku->sampul;

            if($request->hasFile('sampul')) {
                $file = $request->file('sampul');

                if($sampul != null) { 
                    $sampul = $this->imageHelper->uploadImage($file, $this->sampulPath, $sampul);
                } else {
                    $sampul = $this->imageHelper->uploadImage($file, $this->sampulPath);
                }
            }

            $validate['sampul'] = $sampul;

            $buku->update($validate);

            return redirect()->route('buku.index')->with('sukses', 'Berhasil Mengedit Data Buku');
        } catch(Exception $e) {

            return redirect()->back()->with('error', 'Gagal Mengedit Data Buku');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteData = Buku::findOrFail($id);

            if($deleteData->sampul != null) {
                $imageLama = $this->sampulPath . $deleteData->sampul;
                $this->imageHelper->deleteImage($imageLama);
            }

            $deleteData->delete();

            return redirect()->route('buku.index')->with('sukses', 'Berhasil Menghapus Data Buku');
        } catch(Exception $e) { 

            return redirect()->route('buku.index')->with('error', 'Gagal Menghapus Data Buku');
        }
    }

        public function export() {
        return Excel::download(new BukuExport, 'data-buku-perpustakaan.xlsx');
    }

}
