<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pendaftaran::with(['pasien', 'poli', 'dokter'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'poli_id'   => 'required|exists:poli,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal_daftar' => 'sometimes|date', 
        ]);

        $pendaftaran = Pendaftaran::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil dibuat',
            'data' => $pendaftaran->load(['pasien', 'poli', 'dokter'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        return response()->json([
            'success' => true,
            'data' => $pendaftaran->load(['pasien', 'poli', 'dokter'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'pasien_id' => 'sometimes|required|exists:pasien,id',
            'poli_id'   => 'sometimes|required|exists:poli,id',
            'dokter_id' => 'sometimes|required|exists:dokter,id',
            'tanggal_daftar' => 'sometimes|required|date',
        ]);

        $pendaftaran->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil diupdate',
            'data' => $pendaftaran->load(['pasien', 'poli', 'dokter'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil dihapus'
        ]);
    }
}
