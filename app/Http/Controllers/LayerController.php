<?php

namespace App\Http\Controllers;

use App\Http\Resources\LayerResource;
use App\Models\Layer;
use App\Models\LayerChoice;
use App\Models\Subject;
use App\Models\SubjectChoice;
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

    public function create()
    {
        return view('pages.admin.layer-create.layercreate', [
            'layers' => Layer::all(),
            'subjects' => Subject::all(),
            ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $user = \Auth::user();

        if ($user == null || !$user->can('layers.store')) {
            return response('Forbidden',403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:layers,name',
            'editor1' => 'required',
        ]);

        if ($validator->fails()) {
            return view('pages.admin.layer-create.layercreate', [
                'layers' => Layer::all(),
                'subjects' => Subject::all(),
            ])->withErrors($validator->errors());
        }

        $newLayerObject = Layer::create([
            'name' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->editor1,
        ]);

        if ($newLayerObject->save()) {
            $parentType = '';
            $parentId = 0;

            if ($request->parent != null) {
                $parentArray = explode('-',(string) $request->parent);
                $parentType = $parentArray[0];
                $parentId = $parentArray[1];
            }

            if ($parentType != '') {
                if ($parentType == 'subject') {
                    SubjectChoice::create([
                        'name' => $newLayerObject->name,
                        'description' => $newLayerObject->name,
                        'icon' => 'fas fa-brain',
                        'subject_id' => $parentId,
                        'layer_id' => $newLayerObject->id
                    ])->save();
                } else if ($parentType == 'layer') {
                    LayerChoice::create([
                        'parent_layer_id' => $parentId,
                        'child_layer_id' => $newLayerObject->id
                    ])->save();
                }
            }

            return view('pages.admin.layer-create.layercreate', [
                'layers' => Layer::all(),
                'subjects' => Subject::all(),
                'success' => 'Laag "'. $request->title .'" is aangemaakt'
            ]);
        } else {
            return view('pages.admin.layer-create.layercreate', [
                'layers' => Layer::all(),
                'subjects' => Subject::all(),
            ])->withErrors(['error' => 'Layer "'.$request->name.'" could not be created.']);
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
     * @param int $id
     * @return LayerResource
     */
    public function update(Request $request, $id)
    {
        $user = \Auth::user();

        if ($user == null || !$user->can('layers.update')) {
            return response('Forbidden',403);
        }

        Layer::where('id', $id)->update([
            'name' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->editor1
        ]);

        return new LayerResource(Layer::where('id', $id)->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $user = \Auth::user();

        if ($user == null || !$user->can('layers.destroy')) {
            return response('Forbidden',403);
        }

        $layerToDestroy = Layer::where('slug', $slug)->firstOrFail();

        if ($layerToDestroy->delete()) {
            return response()->json(['message' => 'Layer "'.$slug.'" has been deleted.'])->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Layer "'.$slug.'" could not deleted.'])->setStatusCode(500);
        }
    }
}
