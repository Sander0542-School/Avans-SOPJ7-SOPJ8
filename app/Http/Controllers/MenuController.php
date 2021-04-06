<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Subject;
use Cache;

class MenuController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('order');

        return view('pages.admin.menu.index')->with('subjects', $subjects);
    }

    public function update(UpdateRequest $request)
    {
    }
}
