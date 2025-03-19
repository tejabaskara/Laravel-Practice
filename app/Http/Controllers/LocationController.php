<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all(); // Ambil semua lokasi dari database
        return view('map', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Location::create($request->all());

        return redirect()->route('map.index')->with('success', 'Lokasi berhasil disimpan');
    }
}

