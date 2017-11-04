<?php

namespace App\Http\Controllers;

use App\Vocabulary;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = [
            'vocabularies' => Vocabulary::all(),
            'status' => 'success',
            'message' => 'get list'
        ];
        return $res;
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $vocabulary = Vocabulary::find($id);
        if($vocabulary != null){
            $res = [
                'vocabulary' => $vocabulary,
                'status' => 'success',
                'message' => 'find '
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'Error'
            ];
        }
        return $res;
    }


    public function VocaLesson(Request $request){
        $NumberLesson = $request->NumberLesson;
        $vocabularies = Vocabulary::where('LessonNumber','=',$NumberLesson)->get();

        if(count($vocabularies) > 0){
            $res = [
                'vocabularies' => $vocabularies,
                'status' => 'success',
                'message' => 'find '
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'Error'
            ];
        }
        return $res;
    }
}
