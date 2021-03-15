<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLayerRequest;
use App\Http\Resources\LayerResource;
use App\Models\Layer;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LayerController extends Controller
{
    public function index()
    {
        return Layer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return LayerResource
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'exists:layers,name',
        ]);

        $newLayerObject = Layer::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'content' => $request->body,
        ]);

        if ($newLayerObject->save()) {
            return new LayerResource($newLayerObject);
        } else {
            return response()->json(['error' => 'Layer \''.$request->name.'\' could not be created.'])->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return LayerResource
     */
    public function show(string $slug)
    {
        $layer = Layer::where('slug', $slug)->first();

        if (is_null($layer)) {
            return response()->json(['message' => 'Model not found'])->setStatusCode(404);
        }

        return new LayerResource($layer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return LayerResource
     */
    public function edit(string $slug)
    {
        $layer = Layer::where('slug', $slug)->first();

        if (is_null($layer)) {
            return response()->json(['message' => 'Model not found'])->setStatusCode(404);
        }

        return new LayerResource($layer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return LayerResource
     */
    public function update(Request $request, $slug)
    {
        DB::table('layers')->where('slug', $slug)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->body,
        ]);

        $updatedLayer = Layer::where('slug', $slug)->first();

        return new LayerResource($updatedLayer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $layerToDestroy = Layer::where('slug', $slug)->firstOrFail();

        if ($layerToDestroy->delete()) {
            return response()->json(['message' => 'Layer \''.$slug.'\' has been deleted.'])->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Layer \''.$slug.'\' could not deleted.'])->setStatusCode(500);
        }
    }
}
