<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Domain;
use App\Models\Subject;
use Cache;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('order','ASC')->get();

        foreach($subjects as $subject)
        {
            $domain = Domain::find($subject->domain_id);
            $subject->domain_name = $domain->name;
        }

        return view('pages.admin.menu.index',compact('subjects'));
    }

    public function edit()
    {
        $subjects = Subject::orderBy('order','ASC')->get();

        foreach($subjects as $subject)
        {
            $domain = Domain::find($subject->domain_id);
            $subject->domain_name = $domain->name;
        }

        return view('pages.admin.menu.editAll', ['subjects' => $subjects]);
    }

    public function update(Request $request)
    {
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            foreach ($request->order as $order) {
                if ($order['id'] == $subject->id) {
                    $subject->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }

    //public function update(UpdateRequest $request)
    //{
    //    $formSubjects = collect($request->input('subjects', []));
    //    $errors = [];
    //
    //    foreach ($formSubjects as $formSubject) {
    //        $subject = Subject::updateOrCreate([
    //            'id' => $formSubject['id'],
    //        ], [
    //            'domain_id' => $formSubject['domain_id'],
    //            'name' => $formSubject['name'],
    //            'order' => $formSubject['order'],
    //        ]);
    //
    //        if ($subject == null) {
    //            $errors[] = __('admin.menu.errors.subject_not_created_updated', [
    //                'name' => $formSubject['name'],
    //            ]);
    //        }
    //    }
    //
    //    Cache::forget('sidemenu');
    //
    //    return redirect()->back()->withErrors([
    //        'menu' => $errors,
    //    ]);
    //}
}
