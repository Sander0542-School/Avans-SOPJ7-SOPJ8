<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Domain;
use App\Models\Subject;
use Cache;

class MenuController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('order','ASC')->get();
        $domains = Domain::orderBy('name')->get();

        return view('pages.admin.menu.index')
            ->with('subjects', $subjects)
            ->with('domains', $domains);
    }

    public function update(UpdateRequest $request)
    {
        $formSubjects = collect($request->input('subjects', []));
        $errors = [];

        foreach ($formSubjects as $formSubject) {
            $subject = Subject::updateOrCreate([
                'id' => $formSubject['subject_id'],
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
