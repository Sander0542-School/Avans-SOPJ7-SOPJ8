<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'domain_id' => 'required',
            'name' => 'required|unique:subjects,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()])->setStatusCode(400);
        }

        $newSubjectObject = Subject::create([
            'domain_id'=> $request->domain_id,
            'name' => $request->name,
        ]);

        if ($newSubjectObject->save()) {
            return new SubjectResource($newSubjectObject);
        } else {
            return response()->json(['error'=> 'Subject "'.$request->name.'" could not be created.'])->setStatusCode(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return SubjectResource
     */
    public function show($id)
    {
        $subject = Subject::where('id', $id)->findOrFail($id);

        if (is_null($subject)) {
            return response()->json(['message' => 'Model not found'])->setStatusCode(404);
        }

        return new SubjectResource($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return SubjectResource
     */
    public function update(Request $request, $id)
    {
        DB::table('subjects')->where('id', $id)->update($request->all());

        $updatedSubject = Subject::where('id', $id)->firstOrFail();

        if (is_null($updatedSubject)) {
            return response()->json(['message' => 'Model not found'])->setStatusCode(404);
        }

        return new SubjectResource($updatedSubject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::where('id', $id)->findOrFail($id);

        if ($subject->delete()) {
            return response()->json(['message' => 'Subject with id: "'.$id.'" deleted!'])->setStatusCode(200);
        } else {
            return response()->json(['error' => 'Subject with id: "'.$id.'" could not be deleted.'])->setStatusCode(500);
        }
    }
}
