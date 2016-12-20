<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PanelController extends Controller
{

    public function index()
    {
        $view = $this->getView();
        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }

    protected function getView()
    {
        $className = get_class($this);
        $viewName = str_replace('App\Http\Controllers\\', '', $className);
        $viewName = str_replace('\\', '/', $viewName);
        $viewName = str_replace('Controller', '', $viewName);
        $viewName = mb_strtolower($viewName);

        return $viewName;
    }

}
