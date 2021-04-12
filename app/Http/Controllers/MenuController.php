<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Subject;
use Cache;

class MenuController extends Controller
{
    public function index()
    {
        $subjects = Subject::all()->toArray();
        $subjectArray = collect($subjects)->sortBy('order')->toArray();

        return view('pages.admin.menu.index')->with('subjects', $subjectArray);
    }

    //public function edit($id)
    //{
    //    $subject = Subject::find($id);
    //    return view('pages.admin.menu.edit', ['subject' => $subject]);
    //}

    public function edit()
    {
        $subjects = Subject::all()->toArray();
        $subjects = collect($subjects)->sortBy('order')->toArray();

        return view('pages.admin.menu.editAll', ['subjects' => $subjects]);
    }

    public function update(UpdateRequest $request)
    {
        $formSubjects = collect($request->input('subjects', []));
        $errors = [];

        foreach ($formSubjects as $formSubject) {
            $subject = Subject::updateOrCreate([
                'id' => $formSubject['id'],
            ], [
                'domain_id' => $formSubject['domain_id'],
                'name' => $formSubject['name'],
                'order' => $formSubject['order'],
            ]);

            if ($subject == null) {
                $errors[] = __('admin.menu.errors.subject_not_created_updated', [
                    'name' => $formSubject['name'],
                ]);
            }
        }

        Cache::forget('sidemenu');

        return redirect()->back()->withErrors([
            'menu' => $errors,
        ]);
    }
}
