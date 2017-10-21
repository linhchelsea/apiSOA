<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();;
        $res = [
            'lessons' => $lessons,
            'status' => 'success',
            'message' => 'get list'
        ];
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
