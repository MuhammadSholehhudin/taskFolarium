<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Kontrak;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontrakList = Kontrak::with('pegawai', 'jabatan')->get();
        $pegawaiList = Pegawai::all();
        $jabatanList = Jabatan::all();
        $editMode = false;
        return view('index', compact(
            'kontrakList',
            'pegawaiList',
            'jabatanList',
            'editMode'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Kontrak();
        return view('employee', compact(
            'model'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new Kontrak();
        $model->id_pegawai = $request->nama_pegawai;
        $model->id_jabatan = $request->jabatan;
        $model->tgl_mulai_kontrak = $request->start_kontrak;
        $model->tgl_berakhir_kontrak = $request->end_kontrak;
        $model->save();

        return redirect('employee')->with('added', 'Your new data has been added successfully !');
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
        $kontrak = Kontrak::find($id);
        $pegawaiList = Pegawai::all();
        $jabatanList = Jabatan::all();
        $kontrakList = Kontrak::all();
        return view('index', [
            'kontrak' => $kontrak,
            'pegawaiList' => $pegawaiList,
            'jabatanList' => $jabatanList,
            'kontrakList' => $kontrakList
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatedData = Kontrak::find($id);
        $updatedData->id_pegawai = $request->nama;
        $updatedData->id_jabatan = $request->jabatan;
        $updatedData->tgl_mulai_kontrak = $request->start_kontrak;
        $updatedData->tgl_berakhir_kontrak = $request->end_kontrak;
        $updatedData->save();
        return redirect('employee')->with('updated', 'Your data has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kontrak::find($id);
        $data->delete();
        return redirect('employee')->with('deleted', 'Your data deleted successfully !');
    }
}
