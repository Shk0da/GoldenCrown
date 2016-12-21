<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends PanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = parent::index();

        $view->with('list', ServiceType::all());

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/servicetype/create');
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
            'name' => 'unique:service_types|required|min:2',
        ]);

        $serviceType = new ServiceType();
        $serviceType->name = $request->input('name');
        $serviceType->save();


        return redirect()->intended('admin/serviceTypes');
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
        $serviceType = ServiceType::find($id);

        if (!$serviceType) {
            abort(404);
        }

        $view = view('admin/servicetype/edit');
        $view->with('serviceType', $serviceType);

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
            'name' => 'required|min:2|unique:service_types,name,' . $id,
        ]);

        $serviceType = ServiceType::find($id);

        if (!$serviceType) {
            abort(404);
        }

        $serviceType->name = $request->input('name');
        $serviceType->save();

        return redirect()->intended('admin/serviceTypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceType = ServiceType::find($id);

        if ($serviceType) {
            $serviceType->delete();
        }

        return redirect()->intended('admin/serviceTypes');
    }
}
