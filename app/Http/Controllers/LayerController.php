<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLayerRequest;
use App\Http\Resources\LayerResource;
use App\Models\Layer;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LayerController extends Controller
{

    public function index() {
        return Layer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LayerResource
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $text = $request->text;
        $slug = Str::slug($name, '-');
        $createdAt = Carbon::now();
        $updatedAt = $createdAt;

        if (Layer::where('name', $name)->exists()) {
            return response()->json(['Error'=> 'Layer \''.$name.'\' already exists.'])->setStatusCode(400);
        }

        $newLayerObject = Layer::create([
            'name' => $name,
            'slug' => $slug,
            'content' => $text,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        if ($newLayerObject->save()) {
            return response()->json(['Message'=> 'Layer \''.$name.'\' created!'])->setStatusCode(201);
        } else {
            return response()->json(['Error'=> 'Layer \''.$name.'\' could not be created.'])->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return LayerResource
     */
    public function show(string $slug)
    {
        $selectedLayer = Layer::where('slug', $slug)->firstOrFail();

        return new LayerResource($selectedLayer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return LayerResource
     */
    public function edit(string $slug)
    {
        $layerToEdit = Layer::where('slug', $slug)->firstOrFail();

        return new LayerResource($layerToEdit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        DB::table('layers')
            ->where('slug', $slug)
            ->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'content' => $request->text,
                'updated_at' => Carbon::now()
                ]);

        $updatedLayer = Layer::where('slug', $slug)->firstOrFail();

        return new LayerResource($updatedLayer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $layerToDestroy = Layer::where('slug', $slug)->firstOrFail();

        if ($layerToDestroy->delete()) {
            return response()->json(['Message' => 'Layer \''.$slug.'\' has been deleted.'])->setStatusCode(200);
        } else {
            return response()->json(['Error' => 'Layer \''.$slug.'\' could not deleted.'])->setStatusCode(500);
        }
    }
}
