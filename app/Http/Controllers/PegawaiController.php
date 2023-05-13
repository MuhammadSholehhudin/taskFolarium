<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function indexView(){
        try{
            $client = new Client();
            $response = $client->get('http://localhost:8000/api/pegawai');
            var_dump($response);
            $pegawai = json_decode($response->getBody(), true);
            
            return view('pegawai.index',[
                'pegawai' => $pegawai
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
        // return view('pegawai.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        return response()->json($pegawai);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_jabatan' => 'required',
        ]);

        $pegawai = Pegawai::create($validateData);

        return response()->json($pegawai, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pegawai = Pegawai::find($id);
        return response()->json($pegawai);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_jabatan' => 'required',
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->update($validateData);

        return response()->json(['message' => 'Data berhasil diperbarui !'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response()->json(['message' => 'Data berhasil dihapus !'], 204);
    }
}
