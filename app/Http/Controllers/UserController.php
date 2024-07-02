<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cases;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $division_id = Auth::user()->division_id;
        $countKasus = Cases::where('division_id', $division_id)->count();
        $kasus = Cases::where('division_id', $division_id)->with('division')->first();

        $countUser = User::where('division_id', $division_id)->count();
        return view('user.dashboard', compact('countKasus', 'kasus', 'countUser'));
    }

    public function kasus()
    {
        $division_id = Auth::user()->division->id;
        $kasus = Cases::where('division_id', $division_id)->get();
        return view('user.kasus', compact('kasus'));
    }
    public function addKasus()
    {
        return view('user.addKasus');
    }

    public function storeKasus(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_tersangka' => 'required|string|max:255',
            'pasal_yang_disangkakan' => 'required|string|max:255',
            'tahap_dua' => 'required|string|max:255',
            'tanggal_perdamaian' => 'nullable|date',
            'keterangan_detail' => 'nullable|string',
            'judul_berita' => 'required|string|max:255',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_berita' => 'required|string',
            'vidio' => 'required|url',
            'slug' => 'nullable|string|unique:cases,slug',
        ]);

        // Handle file uploads
        if ($request->hasFile('gambar_sampul')) {
            $gambarSampul = $request->file('gambar_sampul');
            $gambarSampulFilename = time() . '_' . $gambarSampul->getClientOriginalName();
            $gambarSampul->storeAs('public/gambar_sampul', $gambarSampulFilename);
            $validatedData['gambar_sampul'] = $gambarSampulFilename;
        }

        // Include user_id and division_id from authenticated user
        $validatedData['user_id'] = Auth::id();
        $validatedData['division_id'] = Auth::user()->division->id;

        // Set the 'tanggal_publish' field to the current timestamp
        $validatedData['tanggal_publish'] = now();

        // Generate a unique slug if it's not provided
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['judul_berita']) . '-' . Str::random(6);
        }

        // Save the validated data to the database
        Cases::create($validatedData);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Case created successfully!');
    }
    public function updateKasus($id)
    {
        $kasus = Cases::where('id', $id)->first();
        return view('user.updateKasus', compact('kasus'));
    }
    public function updateKasusPost(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'id' => 'required|exists:cases,id',
        'nama_tersangka' => 'required|string|max:255',
        'pasal_yang_disangkakan' => 'required|string|max:255',
        'tahap_dua' => 'required|string|max:255',
        'tanggal_perdamaian' => 'nullable|date',
        'keterangan_detail' => 'nullable|string',
        'judul_berita' => 'required|string|max:255',
        'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'content_berita' => 'required|string',
        'vidio' => 'nullable|string',
    ]);

    $id = $validatedData['id'];

    // Find the case record by ID
    $kasus = Cases::findOrFail($id);

    // Update case data
    $kasus->nama_tersangka = $validatedData['nama_tersangka'];
    $kasus->pasal_yang_disangkakan = $validatedData['pasal_yang_disangkakan'];
    $kasus->tahap_dua = $validatedData['tahap_dua'];
    $kasus->tanggal_perdamaian = $validatedData['tanggal_perdamaian'];
    $kasus->keterangan_detail = $validatedData['keterangan_detail'];
    $kasus->judul_berita = $validatedData['judul_berita'];
    $kasus->content_berita = $validatedData['content_berita'];

    // Handle cover image upload if provided
    if ($request->hasFile('gambar_sampul')) {
        // Delete old cover image if exists
        if ($kasus->gambar_sampul) {
            Storage::delete('public/gambar_sampul/' . $kasus->gambar_sampul);
        }

        // Store new cover image
        $gambarSampul = $request->file('gambar_sampul');
        $namaFile = time() . '.' . $gambarSampul->getClientOriginalExtension();
        $gambarSampul->storeAs('public/gambar_sampul', $namaFile);
        $kasus->gambar_sampul = $namaFile;
    }

    // Handle YouTube video URL update if provided
    if ($request->has('vidio')) {
        // Extract video ID from YouTube URL
        $url = $validatedData['vidio'];
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $videoId = isset($query['v']) ? $query['v'] : '';
        $kasus->vidio = $videoId;
    }

    // Save the updated case record
    $kasus->save();

    // Redirect back with success message
    return redirect()->route('user.kasus')->with('success', 'Data kasus berhasil diperbarui!');
}
    public function deleteKasus($id)
    {
        // Cari data kasus berdasarkan ID
        $kasus = Cases::find($id);

        // Jika data ditemukan, hapus data
        if ($kasus) {
            $kasus->delete();
            return redirect()->back()->with('success', 'Case deleted successfully!');
        }

        // Jika data tidak ditemukan, kembalikan pesan error
        return redirect()->back()->with('error', 'Case not found!');
    }
}
