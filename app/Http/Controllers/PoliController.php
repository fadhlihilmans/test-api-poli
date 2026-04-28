<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Poli::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => 'required|string|unique:poli,nama_poli|max:255',
            'kuota'     => 'required|integer|min:1',
        ]);

        $poli = Poli::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Poli berhasil ditambahkan',
            'data'    => $poli
        ], 201);
    }

    public function show(Poli $poli)
    {
        return response()->json([
            'success' => true,
            'data'    => $poli
        ]);
    }

    public function update(Request $request, Poli $poli)
    {
        $validated = $request->validate([
            'nama_poli' => 'sometimes|required|string|max:255|unique:poli,nama_poli,' . $poli->id,
            'kuota'     => 'sometimes|required|integer|min:1',
        ]);

        $poli->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data Poli berhasil diupdate',
            'data'    => $poli
        ]);
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Poli berhasil dihapus'
        ]);
    }
}