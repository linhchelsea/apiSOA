<?php

namespace App\Http\Controllers;

use App\Sentence;
use App\Topic;
use Illuminate\Http\Request;
use Psy\Test\Exception\RuntimeExceptionTest;

class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idTopic = $request->idTopic;
        $topic = Topic::find($idTopic);
        if($topic == null ){
            $res = [
                'status' => 'fail',
                'message' => 'Topic does not exist'
            ];
            return $res;
        }
        $sentences = Sentence::where('IdTopic','=',$idTopic)->get();
        $res = [
            'sentences' => $sentences,
            'status' => 'success',
            'message' => 'get list'
        ];
        return $res;
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
        $sentence->EngSentence = $request->EngSentence;
        $sentence->VieSentence = $request->VieSentence;
        $sentence->save();
        $res = [
            'sentence' => $sentence,
            'status' => 'success',
            'message' => 'get sentence'
        ];
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $sentence = Sentence::find($id);
        if($sentence != null){
            $res = ['sentence' => $sentence,'status'=> 'success', 'message' => 'Find successfully'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Cannot find sentence'];

        }
        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $sentence = Sentence::find($id);
        if($sentence != null){
            $sentence->EngSentence = $request->EngSentence;
            $sentence->VieSentence = $request->VieSentence;
            if('' == $sentence->EngSentence){
                $res = [
                    'status' => 'fail',
                    'message' => 'Blank English Sentence'
                ];
            }else if('' == $sentence->VieSentence ){
                $res = [
                    'status' => 'fail',
                    'message' => 'Blank Vietnamese Sentence'
                ];
            }else{
                $sentence->save();
                $res = [
                    'sentence' => $sentence,
                    'status' => 'success',
                    'message' => 'Updated'
                ];
            }
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'Can not Find'
            ];
        }
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $sentence = Sentence::find($id);
        if($sentence != null){
            $sentence->delete();
            $res = [
                'code' => 204,
                'status' => 'success',
                'message' => 'Deleted'
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
