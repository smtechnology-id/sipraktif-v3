<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cases;
use App\Models\Balita;
use App\Models\Mother;
use App\Models\Report;
use App\Models\Children;
use App\Models\Division;
use App\Models\KaderReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $divisi = Division::withCount('cases')->get();
        return view('admin.dashboard', compact('divisi'));
    }

    public function divisi()
    {
        $divisi = Division::all();
        return view('admin.divisi', compact('divisi'));
    }
    public function addDivision(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data divisi baru
        Division::create([
            'name' => $request->input('name'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Divisi berhasil ditambahkan.');
    }
    public function updateDivision(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'id' => 'required|integer|exists:divisions,id',
        ]);

        // Find the division by ID and update it
        $division = Division::find($request->id);
        $division->name = $request->name;
        $division->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Division updated successfully!');
    }
    public function deleteDivision($id)
    {
        // Find the division by ID and delete it
        $division = Division::findOrFail($id);
        $division->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Division deleted successfully!');
    }


    public function user()
    {
        $user = User::with('division')->whereNotNull('division_id')->get();
        $division = Division::all();
        return view('admin.user', compact('user', 'division'));
    }
    public function addUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'division_id' => $request->division_id,
            'email' => $request->email,
            'level' => 'user',
            'password' => Hash::make($request->password),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User added successfully!');
    }
    public function updateUser(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the user and update the details
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->division_id = $request->division_id;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Redirect back with a success message
        return redirect()->route('admin.user')->with('success', 'User updated successfully!');
    }
    public function deleteUser($id)
    {
        // Find the user by ID and delete
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('admin.user')->with('success', 'User deleted successfully!');
    }
    public function kasus()
    {
        $kasus = Cases::all();
        return view('admin.kasus', compact('kasus'));
    }
}
