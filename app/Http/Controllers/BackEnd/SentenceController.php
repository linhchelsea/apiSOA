<?php

namespace App\Http\Controllers\BackEnd;

use App\Sentence;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SentenceController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sentences = Sentence::orderBy('Id','DESC')
            ->paginate(10);
        if(count($sentences) > 0){
            foreach ($sentences as $sentence){
                $topic = Topic::findOrFail($sentence->IdTopic);
                $sentence->EngName = $topic->EngName;
                $sentence->VieName = $topic->VieName;
            }
        }
        return view('backend.sentences.index')->with('sentences',$sentences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('backend.sentences.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sentence = new Sentence();
        $sentence->IdTopic = $request->Topic;
        $sentence->EngSentence = $request->EngSentence;
        $sentence->VieSentence = $request->VieSentence;
        if($sentence->save()){
            $request->session()->flash('success','Create successfully!');
        }else{
            $request->session()->flash('fail','Create unsuccessfully!');
        }
        return redirect()->route('sentences.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sentence = Sentence::findOrFail($id);
        $topics = Topic::all();
        return view('backend.sentences.edit',compact('topics', 'sentence'));
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
        $sentence = Sentence::findOrFail($id);
        $sentence->IdTopic = $request->Topic;
        $sentence->EngSentence = $request->EngSentence;
        $sentence->VieSentence = $request->VieSentence;
        if($sentence->save()){
            $request->session()->flash('success','Update successfully!');
        }else{
            $request->session()->flash('fail','Update unsuccessfully!');
        }
        return redirect()->route('sentences.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $sentence = Sentence::findOrFail($id);
        if($sentence->delete()){
            $request->session()->flash('success','Delete successfully!');
        }else{
            $request->session()->flash('fail','Delete unsuccessfully!');
        }
        return redirect()->route('sentences.index');
    }
}
