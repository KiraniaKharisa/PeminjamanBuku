<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('auth.auth');
    }

    public function login(Request $request)
    {
        // Validasi input login
        try{                
            $validate = $request->validate([
                'username_login' => 'required',
                'password_login' => 'required'
            ]);

            // Kelompokkan kredensial login
            $credentials = [
                'username' => $validate['username_login'],
                'password' =>$validate['password_login']
            ];

            // Cek apakah user dengan username tersebut ada atau tidak dan passwoednya seuai yang didatabase
            $user = User::where('username', $credentials['username'])->first();
            if(!$user || !Hash::check($credentials['password'], $user->password)) {
                return redirect()->back()->with('error', 'Login Gagal! Username Dan Password Salah.');
            }

            // Cek apakah user sudah diaktifasi oleh admin atau belum
            $is_aktif = $user->is_aktif;
            if($is_aktif == 0) {
                return redirect()->back()->with('error', 'Login Gagal! Akun Anda Belum Diaktifasi Admin.');
            }

            // Jika lolos semua pengecekan, maka loginkan user
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('dashboard');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Registrasi Gagal! Silahkan Coba Lagi.');
        }

    }

    
    public function logout(Request $request)
    {
        // Logika logout user
        try{
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login');
            
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Registrasi Gagal! Silahkan Coba Lagi.');
        }
    }

    public function register(Request $request)
    {
        // Tambahkan session untuk menandai halaman register
        $request->session()->flash('halaman_register', true);

        // Validasi input registrasi
        $validate = $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3|unique:user,username',
            'password' => 'required|min:6|confirmed',
        ]);

        try{
            // Simpan data user baru ke database
            $validate['password'] = Hash::make($validate['password']);
            $validate['role_id'] = 2; // Default role sebagai user biasa
            User::create($validate);
            
            $request->session()->forget('halaman_register');

            return redirect()->route('login')->with('sukses', 'Registrasi Berhasil! Tunggu Konfirmasi Admin.');
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Registrasi Gagal! Silahkan Coba Lagi.');
        }

    }
}
        