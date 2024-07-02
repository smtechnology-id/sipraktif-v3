<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cases;
use App\Models\Balita;
use App\Models\Mother;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        $divisi = Division::all();
        $kasus = Cases::orderBy('created_at', 'desc')->take(6)->get();
        $kasusCount = Cases::all()->count();
        return view('index', compact('divisi', 'kasus', 'kasusCount'));
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil kredensial dari permintaan
        $credentials = $request->only('email', 'password');
        // Coba autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, arahkan ke halaman sesuai level pengguna
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level == 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika autentikasi gagal, arahkan kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->with('error', 'Email or password is incorrect.');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }

    public function dataPerkara($id)
    {
        $kasus = Cases::where('division_id', $id)->get();
        $divisi = Division::all();
        $divisiShow = Division::where('id', $id)->first();

        return view('dataPerkara', compact('kasus', 'divisi', 'divisiShow'));
    }

    public function detailPerkara($slug)
    {
        $divisi = Division::all();
        $kasus = Cases::where('slug', $slug)->first();
        $kasus->tanggal_publish = Carbon::parse($kasus->tanggal_publish)->format('F jS, Y');

        $recentPosts = Cases::orderBy('created_at', 'desc')->take(3)->get();
        return view('detailPerkara', compact('divisi', 'kasus', 'recentPosts'));
    }
    public function tentangRj() {
        $divisi = Division::all();
        $kasus = Cases::orderBy('created_at', 'desc')->take(6)->get();
        $kasusCount = Cases::all()->count();
        return view('tentangRj', compact('divisi', 'kasus', 'kasusCount'));
    }
}
