<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subject\StoreRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display the list of layers
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SubjectResource::collection(Subject::all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \App\Http\Resources\SubjectResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $subject = Subject::find($id);

        if (is_null($subject)) {
            return response()->json(['message' => 'Model not found'])->setStatusCode(404);
        }

        return new SubjectResource($subject);
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

    public function getLastOrder(): int
    {
        $subjects = Subject::orderBy('order','DESC')->get();
        $order = $subjects[0]['order'] + 1;
        return $order;
    }
}
