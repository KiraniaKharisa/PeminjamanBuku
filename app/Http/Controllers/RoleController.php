<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Role::query();

        if($request->filled('search')) {
            $query->where('role', 'like', '%' . $request->search . '%');
        }

        match($request->order) {
            'asc' => $query->orderBy('role', 'asc'),
            'desc' => $query->orderBy('role', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('role', 'asc')
        };

        $data = $query->get();

        return view('dashboard.role.index', [
            'roles' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'role' => 'required|min:2|unique:roles,role',
        ]);

        try{
            $createData = Role::create($validate);

            return redirect()->route('role.index')->with('sukses', 'Data Role berhasil ditambahkan!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Role gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);

        return view('dashboard.role.detail', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        return view('dashboard.role.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'role' => 'required|min:2|unique:roles,role',
        ]);

        try{
            $editData = Role::findOrFail($id);
            $editData->update($validate);

            return redirect()->route('role.index')->with('sukses', 'Data Role berhasil diupdate!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Role gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteData = Role::findOrFail($id);
            $deleteData->delete();

            return redirect()->route('role.index')->with('sukses', 'Data Role berhasil dihapus!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data Role gagal dihapus!');
        }
    }
}
