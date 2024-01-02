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
   
    public function store(Request $request)
    {

        $input = $request->input('data');


        preg_match('/(?P<name>.*) (?P<age>\d+)(?: ?THN| ?TH| ?TAHUN)? (?P<city>.*)/', $input, $matches);


        $name = strtoupper($matches['name']);
        $age = $matches['age'];
        $city = strtoupper($matches['city']);


        $orang = new Orang();


        $orang->name = $name;
        $orang->age = $age;
        $orang->city = $city;


        $orang->save();

       
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
