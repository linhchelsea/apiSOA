<?php

namespace App\Http\Controllers;

use App\Sentence;
use Illuminate\Http\Request;

class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sentence::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return $sentence;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sentence = Sentence::find($id);
        if($sentence != null){
            $res = ['sentence' => $sentence,'status'=> 'success', 'message' => 'Find successfully'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Cannot find sentence'];

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
    public function delete($id)
    {
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
