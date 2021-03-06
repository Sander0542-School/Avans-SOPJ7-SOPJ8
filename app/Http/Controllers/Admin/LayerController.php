<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Layer\StoreRequest;
use App\Http\Requests\Admin\Layer\UpdateRequest;
use App\Models\Layer;
use App\Models\LayerChoice;
use App\Models\LayerHistory;
use App\Models\Subject;
use App\Models\SubjectChoice;
use Illuminate\Support\Str;

class LayerController extends Controller
{
    /**
     * Index page containing all the layers
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $layers = Layer::all(['id', 'name', 'slug']);

        return view('pages.admin.layers.index')->with('layers', $layers);
    }

    /**
     * The HTML page containing the create form of an layer
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $layers = Layer::all();
        $subjects = Subject::all();

        return view('pages.admin.layers.create')->with('layers', $layers)->with('subjects', $subjects);
    }

    /**
     * The HTML page containing the edit form of an layer
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Layer $layer)
    {
        $layers = Layer::all();
        $subjects = Subject::all();

        return view('pages.admin.layers.edit')->with('layer', $layer)->with('layers', $layers)->with('subjects', $subjects);
    }

    /**
     * Create a new layer
     *
     * @param \App\Http\Requests\Admin\Layer\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $layer = Layer::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'content' => $data['content'],
        ]);

        if ($layer == null) {
            return redirect()->back()->withErrors(['error' => 'De laag kon niet worden aangemaakt']);
        }

        $this->handleParent($layer, $data['parent'] ?? null);

        return redirect()->route('admin.layers.index')->with('message', 'De laag is successvol aangemaakt');
    }

    /**
     * Update the layer
     *
     * @param \App\Http\Requests\Admin\Layer\UpdateRequest $request
     * @param \App\Models\Layer $layer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateRequest $request, Layer $layer)
    {
        $data = $request->validated();

        if (! $layer->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'content' => $data['content'],
        ])) {
            return redirect()->back()->withErrors(['error' => 'De laag kon niet worden aangepast']);
        }

        $this->handleParent($layer, $data['parent'] ?? null);

        return redirect()->route('admin.layers.index')->with('message', 'De laag is successvol aangepast');
    }

    public function history(Layer $layer) {
        $changes = LayerHistory::where('layer_id', $layer->id)->get();

        return view('pages.admin.layers.history-index')->with('changes', $changes);
    }

    public function viewchange(LayerHistory $change) {
        $previousChange = null;

        if (LayerHistory::where('layer_id', $change->layer_id)->count() > 1) {
            $previousChange = LayerHistory::where('layer_id', $change->layer_id)->where('id', '<', $change->id)->orderByDesc('id')->first();
        }

        if ($previousChange == $change) {
            $previousChange = null;
        }
        return view('pages.admin.layers.history')->with(['change' => $change, 'layer' => $change->layer()->first(), 'previousChange' => $previousChange ?? null]);
    }

    /**
     * @param \App\Models\Layer $layer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Layer $layer)
    {
        if ($layer == null) {
            return redirect()->back()->withErrors(['error' => 'De laag kan niet verwijderd worden']);
        }

        $layer->delete();

        return redirect()->route('admin.layers.index')
            ->with('success', 'De laag is succesvol gearchiveerd.');
    }

    /**
     * @param $layerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($layerId)
    {
        $layer = Layer::withTrashed()->find($layerId);

        if ($layer == null) {
            return redirect()->back()->withErrors(['error' => 'De layer kan niet hersteld worden']);
        }

        $layer->restore();

        return redirect()->route('admin.layers.index')
            ->with('success', 'De layer is met succes uit het archief gehaald.');
    }

    public function deleted()
    {
        $layers = Layer::onlyTrashed()->paginate(10);

        return view('pages.admin.layers.deleted')->with('layers', $layers);
    }

    /**
     * Set the parent of the layer when filled
     *
     * @param \App\Models\Layer $layer
     * @param null $parent
     * @throws \Exception
     */
    private function handleParent(Layer $layer, $parent = null)
    {
        SubjectChoice::where('layer_id', $layer->id)->delete();
        LayerChoice::where('child_layer_id', $layer->id)->delete();

        if ($parent != null) {
            $parentParts = explode('-', $parent);

            switch ($parentParts[0]) {
                case 'subject':
                    SubjectChoice::create([
                        'subject_id' => $parentParts[1],
                        'layer_id' => $layer->id,
                    ]);
                    break;
                case 'layer':
                    LayerChoice::create([
                        'parent_layer_id' => $parentParts[1],
                        'child_layer_id' => $layer->id,
                    ]);
                    break;
            }
        }
    }
}
