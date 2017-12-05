<?php

namespace App\Http\Controllers\BackEnd;

use App\Lesson;
use App\Vocabulary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderBy('Id','DESC')
            ->paginate(10);
        return view('backend.lessons.index')->with('lessons',$lessons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new Lesson();
        $lesson->LessonNameEn = $request->LessonNameEn;
        $lesson->LessonNameVi = $request->LessonNameVi;
        if($request->file('image') != null){
            $checkFile = self::CheckFileUpload($request->file('image')->getClientOriginalName());
            if(!$checkFile){
                $request->session()->flash('fail','Image format is invalid (jpg,jpeg,png,gif)!');
                return redirect()->back();
            }
            $image = $request->file('image')->store('public/lesson');
            $arr_filename = explode("/",$image);
            $filename = end($arr_filename);
        }else{
            $filename = 'default.png';
        }
        $lesson->LessonPathImage = $filename;

        if($lesson->save()){
            $request->session()->flash('success','Create successfully!');
        }else{
            $request->session()->flash('fail','Create unsuccessfully!');
        }
        return redirect()->route('lessons.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('backend.lessons.edit', compact('lesson'));
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
        $lesson = Lesson::findOrFail($id);
        $lesson->LessonNameEn = $request->LessonNameEn;
        $lesson->LessonNameVi = $request->LessonNameVi;
        if($request->file('image') != null){
            $checkFile = self::CheckFileUpload($request->file('image')->getClientOriginalName());
            if(!$checkFile){
                $request->session()->flash('fail','Image format is invalid (jpg,jpeg,png,gif)!');
                return redirect()->back();
            }
            //xoa anh cu~
            if($lesson->LessonPathImage != 'default.png') {
                File::delete('storage/lesson/' . $lesson->LessonPathImage);
            }
            $image = $request->file('image')->store('public/lesson');
            $arr_filename = explode("/",$image);
            $filename = end($arr_filename);
        }else{
            $filename = $lesson->LessonPathImage;
        }
        $lesson->LessonPathImage = $filename;
        if($lesson->save()){
            $request->session()->flash('success','Update successfully!');
        }else{
            $request->session()->flash('fail','Update unsuccessfully!');
        }
        return redirect()->route('lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $lesson = Lesson::findOrFail($id);
        //xoa danh sach Vocabulary
        $vocabularies = Vocabulary::where('LessonNumber','=',$lesson->id)
            ->get();
        if(count($vocabularies) > 0){
            foreach ($vocabularies as $voca){
                //xoa anh cu~
                if($voca->VocaPath != 'default.png') {
                    File::delete('storage/vocabulary/' . $voca->VocaPath);
                }
                $voca->delete();
            }
        }
        //xoa anh cua lesson
        if($lesson->LessonPathImage != 'default.png') {
            File::delete('storage/lesson/' . $lesson->LessonPathImage);
        }
        if($lesson->delete()){
            $request->session()->flash('success','Delete successfully!');
        }else{
            $request->session()->flash('fail','Delete unsuccessfully!');
        }
        return redirect()->back();
    }

    public static function CheckFileUpload($filename){
        $arrFilename = explode('.',$filename);
        $format = $arrFilename[count($arrFilename)-1];
        if ($format == 'png' || $format == 'jpg' ||$format == 'jpeg' ||$format == 'gif' ){
            return true;
        }
        return false;
    }
}
