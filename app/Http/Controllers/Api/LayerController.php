<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LayerResource;
use App\Models\Layer;

class LayerController extends Controller
{
    /**
     * Display the list of layers
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return LayerResource::collection(Layer::all());
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \App\Http\Resources\LayerResource|\Illuminate\Http\JsonResponse
     */
    public function show(string $slug)
    {
        $layer = Layer::firstWhere('slug', $slug);

        if (is_null($layer)) {
            return response()->json(['message' => 'Model not found'])->setStatusCode(404);
        }

        return new LayerResource($layer);
    }
}
