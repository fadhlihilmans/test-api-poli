<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            $poli = Poli::findOrFail($validated['poli_id']);
            if ($poli->kuota <= 0) {
                throw new \Exception("Kuota untuk poli ini sudah habis.");
            }
            $poli->decrement('kuota'); 
            $dataPendaftaran = Pendaftaran::create($validated);
        
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil dibuat',
                'data'    => $dataPendaftaran->load(['pasien', 'poli', 'dokter']), 
            ], 201);

        } catch (\Exception $e) {
            
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan pendaftaran: ' . $e->getMessage(),
            ], 500);
        }
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
