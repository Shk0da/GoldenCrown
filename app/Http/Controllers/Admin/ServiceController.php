<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends PanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = parent::index();
        $view->with('list', Service::all());

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/service/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:services|required|min:2',
            'type' => 'required',
            'time' => 'required|integer|min:1',
            'cost' => 'required|min:0.01',
        ]);

        $service = new Service();
        $service->name = $request->input('name');
        $service->type = $request->input('type');
        $service->time = $request->input('time');
        $service->cost = $request->input('cost');
        $service->save();


        return redirect()->intended('admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        $view = view('admin/service/edit');
        $view->with('service', $service);

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|unique:services,name,' . $id,
            'type' => 'required',
            'time' => 'required|integer|min:1',
            'cost' => 'required|min:0.01',
        ]);

        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        $service->name = $request->input('name');
        $service->type = $request->input('type');
        $service->time = $request->input('time');
        $service->cost = $request->input('cost');
        $service->save();

        return redirect()->intended('admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if ($service) {
            $service->delete();
        }

        return redirect()->intended('admin/services');
    }
}
