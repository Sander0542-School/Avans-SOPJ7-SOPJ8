<?php

namespace App\Http\Controllers;

use App\Http\Resources\LayerResource;
use App\Models\Layer;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
