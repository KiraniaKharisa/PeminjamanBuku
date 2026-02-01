<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Helper\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $imageHelper;
    protected $profilPath = 'image/profil/';
     
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        match($request->order) {
            'asc' => $query->orderBy('nama', 'asc'),
            'desc' => $query->orderBy('nama', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'oldest' => $query->orderBy('created_at', 'asc'),
            default => $query->orderBy('nama', 'asc')
        };

        $data = $query->get();

        return view('dashboard.user.index', [
            'users' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('dashboard.user.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' =>'required|min:2',
            'username' => 'required|min:3|unique:user,username',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|exists:role,id_role',
            'profil' => 'nullable|image|mimes:jpg,jpeg,png|max:3072' //max 3mb
        ]);

        try{
            $file = null;
            if($request->hasFile('profil')) {
                $file = $request->file('profil');
                $file = $this->imageHelper->uploadImage($file, $this->profilPath);
            }

            $validate['profil'] = $file;
            $validate['password'] = Hash::make($validate['password']);
            $createData = User::create($validate);

            return redirect()->route('user.index')->with('sukses', 'Data User berhasil ditambahkan!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data User gagal ditambahkan!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('dashboard.user.detail',[
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);

        return view('dashboard.user.edit',[
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'nama' =>'required|min:2',
            'username' => "required|min:3|unique:user,username,$id,id_user",
            'role_id' => 'required|exists:role,id_role',
            'profil' => 'nullable|image|mimes:jpg,jpeg,png|max:3072', //max 3mb
            'inputHapus' => 'required|in:true,false'
        ]);
        
        try{
            $user = User::findOrFail($id);
            $profil = $user->profil;

            if($validate['inputHapus'] == 'true') {
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

            return redirect()->route('user.index')->with('sukses', 'Data User berhasil diubah!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Data User gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteData = User::findOrFail($id);

            if($deleteData->profil != null) {
                $imageLama = $this->profilPath . $deleteData->profil;
                $this->imageHelper->deleteImage($imageLama);
            }
            
            $deleteData->delete();

            return redirect()->route('user.index')->with('sukses', 'Data User berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->route('user.index')->with('error', 'Data User gagal dihapus!');
        }
    }
}
