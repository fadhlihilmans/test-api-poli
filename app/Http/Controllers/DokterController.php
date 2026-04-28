<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Dokter::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dokter' => 'required|string|unique:dokter,nama_dokter|max:255',
        ]);

        $dokter = Dokter::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Dokter berhasil ditambahkan',
            'data'    => $dokter
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        return response()->json([
            'success' => true,
            'data'    => $dokter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
         $validated = $request->validate([
            'nama_dokter' => 'sometimes|required|string|max:255|unique:dokter,nama_dokter,' . $dokter->id,
        ]);

        $dokter->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Dokter berhasil diupdate',
            'data'    => $dokter,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Dokter berhasil dihapus'
        ]);
    }
}
