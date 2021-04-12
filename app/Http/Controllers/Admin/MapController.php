<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('pages.admin.map.index');
    }

    public function update(Request $request) {
        dump($request->get('subjects'));
    }
}
