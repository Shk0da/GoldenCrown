<?php

namespace App\Http\Controllers;


class MainController extends Controller
{
    public function index()
    {
        $view = view('main');

        return $view;
    }
}