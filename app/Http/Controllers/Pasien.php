<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pasien extends Controller
{
    public function index() {

        $response = Http::get('http://localhost:8080/pasien');
        $pasiens = $response->json();

        $data = array(
            'title'         => 'Kelola Pasien',
        );
        return view('pasien/index',$data,[
            'pasiens' => $pasiens['data_pasien']
        ]);
    }

    public function autocomplete(Request $request)
{
    $q = $request->get('q');

    // Panggil API backend CI untuk cari pasien yang cocok
    $response = Http::get('http://localhost:8080/pasien/search', [
    'search' => $q
    ]);
    
        if ($response->successful()) {
        $pasiens = $response->json();
        $results = [];
        foreach ($pasiens['data_pasien'] as $pasien) {
            $results[] = [
                'id' => $pasien['id'],
                'text' => $pasien['nama'],
            ];
            }
            return response()->json($results);
        }
        return response()->json([]);

}

 public function create()
{
    $data = ['title' => 'Tambah Pasien'];
    return view('pasien/create', $data);
}

public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat'  => 'required|string|max:255',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'    => 'required|string',
    ]);

    // Kirim data ke API backend
    $response = Http::post('http://localhost:8080/pasien', [
        'nama' => $validated['nama'],
        'alamat'  => $validated['alamat'],
        'tanggal_lahir'  => $validated['tanggal_lahir'],
        'jenis_kelamin'    => $validated['jenis_kelamin'],
    ]);

    if ($response->successful()) {
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambah!');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pasien.');
    }
}

public function edit($id)
{
    $response = Http::get("http://localhost:8080/pasien/{$id}");
    $pasiens = $response->json();

    $pasien = $pasiens['pasien_byid'];
    if (!$response->successful() || !$pasien) {
        return redirect()->route('pasien.index')->with('error', 'Pasien tidak ditemukan.');
    }

    return view('pasien/edit', ['pasien' => $pasien, 'title' => 'Edit Pasien']);
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat'  => 'required|string|max:255',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'    => 'required|string',
    ]);

    $response = Http::put("http://localhost:8080/pasien/{$id}", $validated);

    if ($response->successful()) {
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
    } else {
        return redirect()->back()->with('error', 'Gagal memperbarui data pasien.');
    }

    }
    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/pasien/{$id}");

        if ($response->successful()) {
            return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pasien.');
        }
    }
}