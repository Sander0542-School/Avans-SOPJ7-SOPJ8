<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Map\UpdateRequest;
use App\Http\Requests\Admin\Subject\StoreRequest;
use App\Models\Domain;
use App\Models\Subject;

class MapController extends Controller
{
    public function index()
    {
        $domains = Domain::all();

        return view('pages.admin.map.index')
            ->with('domains', $domains);
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
}
