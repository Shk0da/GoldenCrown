<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends PanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = parent::index();
        $view->with('list', Employee::orderBy('id', 'asc')->get());

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/employee/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:employees|required|min:2',
            'photo' => 'image',
        ]);

        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->time = json_encode($request->input('times'));
        $employee->save();

        if ($request->hasFile('photo'))
        {
            $path = $request->photo->storeAs('photos', $employee->getId() . '.png', 'public');
            $employee->photo = $path;
            $employee->save();
        }

        return redirect()->intended('admin/employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404);
        }

        $view = view('admin/employee/edit');
        $view->with('employee', $employee);

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:employees,name,' . $id,
            'photo' => 'image',
        ]);

        $employee = Employee::find($id);

        if (!$employee) {
            abort(404);
        }

        $employee->name = $request->input('name');
        $employee->time = json_encode($request->input('times'));
        $employee->save();

        if ($request->hasFile('photo'))
        {
            $path = $request->photo->storeAs('photos', $employee->getId() . '.png', 'public');
            $employee->photo = $path;
            $employee->save();
        }

        return redirect()->intended('admin/employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            //TODO удаление фото
            $employee->delete();
        }

        return redirect()->intended('admin/employee');
    }
}
