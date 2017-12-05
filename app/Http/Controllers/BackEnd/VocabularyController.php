<?php

namespace App\Http\Controllers\BackEnd;

use App\Lesson;
use App\Vocabulary;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vocabularies = Vocabulary::orderBy('Id','DESC')
            ->paginate(12);
        if(count($vocabularies) > 0){
            foreach ($vocabularies as $vocabulary){
                $lesson = Lesson::findOrFail($vocabulary->LessonNumber);
                $vocabulary->lessonNameEn = $lesson->LessonNameEn;
                $vocabulary->lessonNameVi = $lesson->LessonNameVi;
            }
        }
        return view('backend.vocabularies.index')->with('vocabularies',$vocabularies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = Lesson::all();
        return view('backend.vocabularies.create', compact('lessons', $lessons));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vocabulary = new Vocabulary();
        $vocabulary->VocaCategory = $request->VocaCategory;
        $vocabulary->VocaExample = $request->VocaExample;
        $vocabulary->VocaExplain = $request->VocaExplain;
        $vocabulary->LessonNumber = $request->LessonNumber;
        $vocabulary->VocaPronouce = $request->VocaPronouce;
        $vocabulary->VocaEn = $request->VocaEn;
        $vocabulary->VocaVi = $request->VocaVi;
        if($request->file('image') != null){
            $checkFile = app('App\Http\Controllers\BackEnd\LessonController')->CheckFileUpload($request->file('image')->getClientOriginalName());
            if(!$checkFile){
                $request->session()->flash('fail','Image format is invalid (jpg,jpeg,png,gif)!');
                return redirect()->back();
            }
            $image = $request->file('image')->store('public/vocabulary');
            $arr_filename = explode("/",$image);
            $filename = end($arr_filename);
        }else{
            $filename = 'default.png';
        }
        $vocabulary->VocaPath = $filename;

        if($vocabulary->save()){
            $request->session()->flash('success','Create successfully!');
        }else{
            $request->session()->flash('fail','Create unsuccessfully!');
        }
        return redirect()->route('vocabularies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vocabulary = Vocabulary::findOrFail($id);
        $lesson = Lesson::findOrFail($vocabulary->LessonNumber);
        return view('backend.vocabularies.show',compact('vocabulary', 'lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vocabulary = Vocabulary::findOrFail($id);
        $lessons = Lesson::all();
        return view('backend.vocabularies.edit',compact('vocabulary', 'lessons'));
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
    public function destroy($id, Request $request)
    {
        $vocabulary = Vocabulary::findOrFail($id);
        if($vocabulary->VocaPath != 'default.png') {
            File::delete('storage/vocabulary/' . $vocabulary->VocaPath);
        }
        if($vocabulary->delete()){
            $request->session()->flash('success','Delete successfully!');
        }else{
            $request->session()->flash('fail','Delete unsuccessfully!');
        }
        return redirect()->route('vocabularies.index');
    }
}
