<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orang;
use Illuminate\Http\Request;

class OrangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    private function extractAge($input)
    {
        $inputArr = explode(' ', $input); // Membagi input menjadi array berdasarkan spasi

        // Mencari usia yang mungkin muncul di awal atau tengah string
        $possibleAge = array_filter($inputArr, function ($item) {
            return preg_match('/^\d+(?:THN|TAHUN|TH)?$/i', $item); // Pola untuk memeriksa apakah elemen hanya berisi usia
        });

        // Mengambil angka yang sesuai jika ditemukan
        if (!empty($possibleAge)) {
            return reset($possibleAge);
        }

        return null; // Mengembalikan null jika tidak ada pola yang cocok
    }

    public function store(Request $request)
    {
        // Mengambil nilai input 'data' dari request yang dikirimkan oleh pengguna
        $input = $request->input('data');

        // Mencocokkan pola input dengan ekspresi reguler untuk memisahkan nama, usia, dan kota
        preg_match('/(?P<name>.*) (?P<age>\d+)(?: ?THN| ?TH| ?TAHUN)? (?P<city>.*)/', $input, $matches);

        // Mengambil nilai nama, usia, dan kota dari hasil pencocokan pola
        $name = strtoupper($matches['name']); // Mengubah nama menjadi huruf kapital
        $age = $matches['age']; // Mengambil nilai usia
        $city = strtoupper($matches['city']); // Mengubah kota menjadi huruf kapital

        // Membuat objek baru dari model 'Orang' (asumsi ini adalah model yang digunakan untuk entitas orang)
        $orang = new Orang();

        // Menyimpan nilai nama, usia, dan kota ke dalam properti objek $orang
        $orang->name = $name;
        $orang->age = $age;
        $orang->city = $city;

        // Menyimpan data ke dalam database menggunakan metode save() dari model 'Orang'
        $orang->save();

        // Mengembalikan pesan JSON yang menyatakan data berhasil disimpan
        return response()->json(['message' => 'Data saved successfully']);

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
