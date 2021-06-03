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
        return SubjectResource::collection(Subject::with(['layers' => function ($query) {
            $query->select(['layers.id', 'layers.name', 'layers.slug']);
        }])->get());
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
}
