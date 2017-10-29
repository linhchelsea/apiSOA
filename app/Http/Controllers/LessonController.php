<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\UserLearnt;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
                    ->first();
        if($user != null){
            //lay danh sach lesson da va dang hoc cua user
//            $userLearnts = UserLearnt::where('IdUser','=',$user->id)->get();

            try {
                $userLearnts = UserLearnt::where('IdLesson','=',7)->get();
            } catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
            }
            dd($userLearnts);
            $arr_IdLessons = array();
            $arr_LessonsPoint = array();
            foreach ($userLearnts as $userLearnt){
                array_push($arr_IdLessons, $userLearnt->IdLesson);
                array_push($arr_LessonsPoint, $userLearnt->LessonPoint);
            }
            dd($arr_IdLessons);
            $lessons = Lesson::all();;
            foreach ($lessons as $lesson){
                $lesson->isLock = true;
                $key = array_search($lesson->Id, $arr_IdLessons);
                if($key !== false){
                    $lesson->isLock = false;
                    //lay diem cua bai hoc
                    $lesson->Point = $arr_LessonsPoint[$key];
                }
            }
            $res = [
                'lessons' => $lessons,
                'status' => 'success',
                'message' => 'get list'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'Can not find user'
            ];
        }

        return $res;
    }



    public function show($id)
    {
        $lesson = Lesson::find($id);
        if($lesson != null){
            $res = [
                'lesson' => $lesson,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
