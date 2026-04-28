<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Pasien::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_rm'     => 'required|string|unique:pasien,nomor_rm',
            'nama_pasien' => 'required|string|unique:pasien,nama_pasien|max:255',
            'alamat'      => 'nullable|string',
        ]);

        $pasien = Pasien::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Pasien berhasil ditambahkan',
            'data'    => $pasien
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        return response()->json([
            'success' => true,
            'data'    => $pasien
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'nomor_rm' => 'sometimes|required|string|max:255|unique:pasien,nomor_rm,' . $pasien->id,
            'nama_pasien' => 'sometimes|required|string|max:255|unique:pasien,nama_pasien,' . $pasien->id,
            'alamat' => 'nullable|string',
        ]);

        $pasien->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Pasien berhasil diupdate',
            'data'    => $pasien
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Pasien berhasil dihapus'
        ]);
    }
}
