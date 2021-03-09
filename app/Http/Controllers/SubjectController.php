<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function Index(){
        foreach (Subject::all() as $subject){
            return $subject->name;
        }
    }

    public function Find(Subject $subject){
        return $subject = Subject::where('domain_id', domainId)
                            ->orderBy('name')
                            ->get();
    }

    public function Store(Request $request){
        $subject = new Subject;

        $subject->name = $request->name;

        $subject->save();

        //$subject = subject.create([
        //    'name' => 'Lorem Ipsum'
        //    ]);
    }

    public function Update(Subject $subject){
        $subject = Subject::find(1);

        $subject->name = 'Lorem Ipsum';

        $subject->save();
    }

    public function Delete(Subject $subject){
        $subject = Subject::find(1);

        $subject->delete();
    }
}
