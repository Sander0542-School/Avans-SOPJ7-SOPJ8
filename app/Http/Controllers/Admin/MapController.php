<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Map\UpdateRequest;
use App\Http\Requests\Admin\Subject\StoreRequest;
use App\Models\Domain;
use App\Models\Subject;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $domains = Domain::all();
        $subjects = Subject::all();
        return view('pages.admin.map.index')
            ->with('domains', $domains)->with('subjects', $subjects);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $subject = Subject::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'lon' => 6.581911,
            'lat' => 52.121066,
            'domain_id' => $data['domain_id'],
            'order' => $this->getLastOrder(),
        ]);

        return redirect()->route('admin.map.index')->with('success', 'Het onderwerp is toegevoegd!');
    }

    public function update(UpdateRequest $request)
    {
        $formSubjects = $request->validated()['subjects'];

        foreach ($formSubjects as $formSubject) {
            $subject = Subject::find($formSubject['id']);
            $subject->lat = $formSubject['lat'];
            $subject->lon = $formSubject['lon'];

            if (! $subject->save()) {
                return response()->json(['error' => 'Het onderwerp "'.$request->name.'" kon niet verplaatst worden.'])->setStatusCode(500);
            }
        }

        return redirect()->route('admin.map.index')->with('success', 'Het onderwerp is  succesvol verplaatst!');
    }

    private function getLastOrder()
    {
        return Subject::max('order') ?? 0 + 1;
    }

    public function destroy(Request $request)
    {
        $subjectChoise = $request -> subjectChoise;
        $choices = Subject::all()->where('subject_id', $subjectChoise);
        $choices->delete();


        //$choices = SubjectChoice::all()->where('subject_id', $subject->id);

        /*        $selected = [];
                foreach ($choices as $subject => $value){
                    if ($choices->selected == true) {
                        $selected[] = $value;
                        $choices->forget($subject);
                    }
                }*/
        //Subject::all()->where('subject_id', $subject->id)->delete();

        //$subject->delete();

        return redirect()->route('admin.map.index')
            ->with('success', 'Het onderwerp is succesvol verwijderd.');
    }
}
