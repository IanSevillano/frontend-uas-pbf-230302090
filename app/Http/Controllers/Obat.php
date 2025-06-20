<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Obat extends Controller
{
    public function index() {

        $response = Http::get('http://localhost:8080/obat');
        $obats = $response->json();

        $data = array(
            'title'         => 'Kelola Obat',
        );
        return view('obat/index',$data,[
            'obats' => $obats['data_obat']
        ]);
    }

    public function autocomplete(Request $request)
{
    $q = $request->get('q');

    // Panggil API backend CI untuk cari obat yang cocok
    $response = Http::get('http://localhost:8080/obat/search', [
    'search' => $q
    ]);
    
        if ($response->successful()) {
        $obats = $response->json();
        $results = [];
        foreach ($obats['data_obat'] as $obat) {
            $results[] = [
                'id' => $obat['id'],
                'text' => $obat['nama_obat'],
            ];
            }
            return response()->json($results);
        }
        return response()->json([]);

}

 public function create()
{
    $data = ['title' => 'Tambah Obat'];
    return view('obat/create', $data);
}

public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'nama_obat' => 'required|string|max:255',
        'kategori'  => 'required|string|max:255',
        'stok'  => 'required|integer',
        'harga'    => 'required|numeric',
    ]);

    // Kirim data ke API backend
    $response = Http::post('http://localhost:8080/obat', [
        'nama_obat' => $validated['nama_obat'],
        'kategori'  => $validated['kategori'],
        'stok'  => $validated['stok'],
        'harga'    => $validated['harga'],
    ]);

    if ($response->successful()) {
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambah!');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan obat.');
    }
}

public function edit($id)
{
    $response = Http::get("http://localhost:8080/obat/{$id}");
    $obats = $response->json();

    $obat = $obats['obat_byid'];
    if (!$response->successful() || !$obat) {
        return redirect()->route('obat.index')->with('error', 'Obat tidak ditemukan.');
    }

    return view('obat/edit', ['obat' => $obat, 'title' => 'Edit Obat']);
}


public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama_obat' => 'required|string|max:255',
        'kategori'  => 'required|string|max:255',
        'stok'  => 'required|integer',
        'harga'    => 'required|numeric',
    ]);

    $response = Http::put("http://localhost:8080/obat/{$id}", $validated);

    if ($response->successful()) {
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui!');
    } else {
        return redirect()->back()->with('error', 'Gagal memperbarui data obat.');
    }

    }
    public function destroy($id)
    {
        $response = Http::delete("http://localhost:8080/obat/{$id}");

        if ($response->successful()) {
            return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus obat.');
        }
    }
}