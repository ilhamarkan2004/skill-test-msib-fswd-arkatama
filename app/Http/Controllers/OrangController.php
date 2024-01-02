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

        // Mengambil kata yang berisi angka yang mungkin merupakan usia
        $possibleAge = array_filter($inputArr, function ($item) {
            return preg_match('/\d+(?:THN|TAHUN|TH)?/i', $item);
        });

        // Jika ada angka yang cocok, kita mengembalikan nilai tersebut
        if (!empty($possibleAge)) {
            return reset($possibleAge);
        }

        return null; // Mengembalikan null jika tidak ada pola yang cocok
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input('data'); // Mendapatkan data dari form
        $exploded = explode(' ', $input); // Membagi data menjadi array berdasarkan spasi

        // Mengubah nama dan kota menjadi huruf kapital
        $name = strtoupper($exploded[0]); // Nama diubah menjadi huruf kapital
        $city = strtoupper(implode(' ', array_slice($exploded, 2))); // Kota diubah menjadi huruf kapital, diambil dari indeks 2 ke depan

        // Menyimpan ke dalam database
        $orang = new Orang();
        $orang->name = $name;
        $orang->age = $this->extractAge($input); // Mengambil usia dari input
        $orang->city = $city;

        // Menyimpan jika usia tidak null
        if ($orang->age !== null) {
            $orang->save();
            return response()->json(['message' => 'Data saved successfully']);
        }

        return response()->json(['message' => 'Failed to save data: Invalid age']);
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
