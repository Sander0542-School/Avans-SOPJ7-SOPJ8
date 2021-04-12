<?php

namespace App\Http\Controllers;

use App\Http\Resources\LayerResource;
use App\Models\Layer;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LayerController extends Controller
{
    public function index()
    {
        return Layer::all();
    }

    public function layerCreateTest() {
        $layers = Layer::all();
        $subjects = Subject::all();
        return view('pages.admin.layer-create.layercreate',['layers'=>$layers,'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Illuminate\Http\Request $request
     * @return LayerResource
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:layers,name',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()])->setStatusCode(400);
        }

        $newLayerObject = Layer::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'content' => $request->body,
        ]);

        if ($newLayerObject->save()) {
            return new LayerResource($newLayerObject);
        } else {
            return response()->json(['error' => 'Layer "'.$request->name.'" could not be created.'])->setStatusCode(500);
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return LayerResource
     */
    public function update(Request $request, $slug)
    {
        DB::table('layers')->where('slug', $slug)->update($request->all());

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
            return response()->json(['message' => 'Layer "'.$slug.'" has been deleted.'])->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Layer "'.$slug.'" could not deleted.'])->setStatusCode(500);
        }
    }
}
