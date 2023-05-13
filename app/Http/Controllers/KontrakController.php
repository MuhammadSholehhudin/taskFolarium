<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontrak = Kontrak::all();
        return response()->json($kontrak);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_kontrak' => 'required',
            'id_pegawai' => 'required',
            'id_jabatan' => 'required',
            'tgl_mulai_kontrak' => 'required',
            'tgl_berakhir_kontrak' => 'required'
        ]);

        $kontrak = Kontrak::create($validateData);

        return response()->json($kontrak, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kontrak = Kontrak::find($id);
        return response()->json($kontrak);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'id_kontrak' => 'required',
            'id_pegawai' => 'required',
            'id_jabatan' => 'required',
            'tgl_mulai_kontrak' => 'required',
            'tgl_berakhir_kontrak' => 'required'
        ]);

        $kontrak = Kontrak::find($id);
        $kontrak->update($validateData);

        return response()->json(['message' => 'Data berhasil diperbarui !'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kontrak = Kontrak::find($id);
        $kontrak->delete();

        return response()->json(['message' => 'Data berhasil dihapus !'], 204);
    }
}
