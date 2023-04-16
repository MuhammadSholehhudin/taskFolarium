<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Employee::all();
        return view('index', compact(
            'datas'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Employee;
        return view('employee', compact(
            'model'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new Employee;
        $model->name = $request->name;
        $model->birth_of_date = $request->dob;
        $model->title = $request->title;
        $model->id_employee = $request->nip;
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
        $data = Employee::find($id);
        return view('edit', compact(
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updatedData = Employee::find($id);
        $updatedData->name = $request->name;
        $updatedData->birth_of_date = $request->dob;
        $updatedData->title = $request->title;
        $updatedData->id_employee = $request->nip;
        $updatedData->save();
        return redirect('employee')->with('updated', 'Your data has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect('employee')->with('deleted', 'Your data deleted successfully !');
    }
}
