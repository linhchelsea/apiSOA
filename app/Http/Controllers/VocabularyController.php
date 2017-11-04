<?php

namespace App\Http\Controllers;

use App\Memorize;
use App\User;
use App\UserLearnt;
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
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        if($user == null){
            return response()->json([
                'status' => 'fail',
                'message' => 'User is not existed!'
            ]);
        }
        $userLearnt = UserLearnt::where('IdUser','=',$user->id)
                                ->where('IdLesson','=',$NumberLesson)
                                ->first();
        if($userLearnt == null){
            return response()->json([
                'status' => 'fail',
                'message' => 'This lesson is blocked to you'
            ]);
        }
        $vocabularies = Vocabulary::where('LessonNumber','=',$NumberLesson)->get();
        foreach ($vocabularies as $vocabulary){
            $memorizes = Memorize::where('IdUser','=',$user->id)
                                    ->where('IdVocabulary','=',$vocabulary->Id)
                                    ->select('Id','Content')
                                    ->get();
            if(count($memorizes) > 0){
                $vocabulary->memorizes = $memorizes;
            }
        }
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
