<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\Admin\Map\UpdateRequest;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('pages.admin.map.index');
    }

    public function update(UpdateRequest $request)
    {
        $formSubjects = $request->validated()['subjects'];

        foreach ($formSubjects as $formSubject) {
            $subject = Subject::find($formSubject['id']);
            $subject->lat = $formSubject['lat'];
            $subject->lon = $formSubject['lon'];

            $subject->save();

            if ($subject == null) {
                return response()->json(['error' => 'Het onderwerp "' . $request->name . '" kon niet verplaatst worden.'])->setStatusCode(500);
            }
        }

        return redirect()->route('admin.map.index')->with('success', 'Het onderwerp is  succesvol verplaatst!');
    }
}
