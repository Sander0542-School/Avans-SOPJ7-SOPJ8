<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectArray =[];
        foreach (Subject::all() as $subject) {
             array_push($subjectArray, ['id'=>$subject->id, 'name'=>$subject->name]);
        }

        return response()->json($subjectArray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // later toegevoegd
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $domain_id = $request->domain_id;
        $name = $request->name;
        $created_at = Carbon::now();
        $updated_at = $created_at;

        if (Subject::where('name', $name)->exists()) {
            return response()->json(['Error' => 'Subject \''.$name.'\' already exists.'])->setStatusCode(400);
        }

        $newSubjectObject = Subject::create([
            'domain_id'=> $domain_id,
            'name' => $name,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        if ($newSubjectObject->save()) {
            return response()->json(['Message'=> 'Subject \''.$name.'\' created!'])->setStatusCode(201);
        } else {
            return response()->json(['Error'=> 'Subject \''.$name.'\' could not be created.'])->setStatusCode(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SubjectResource(Subject::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        // later toegevoegd
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->id = $request->id;
        $subject->domain_id = $request->domain_id;
        $subject->name = $request->name;
        $subject->created_at = $request->created_at;
        $subject->updated_at = $request->updated_at;

        if ($subject->save()) {
            return response()->json(['Message' => 'Subject with id: \''.$id.'\' updated!'])->setStatusCode(200);
        } else {
            return response()->json(['Error' => 'Subject with id: \''.$id.'\' could not be updated.'])->setStatusCode(400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        if ($subject->delete()) {
            return response()->json(['Message' => 'Subject with id: \''.$id.'\' deleted!'])->setStatusCode(200);
        } else {
            return response()->json(['Error' => 'Subject with id: \''.$id.'\' could not be deleted.'])->setStatusCode(400);
        }
    }
}
