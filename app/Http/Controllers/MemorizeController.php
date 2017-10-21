<?php

namespace App\Http\Controllers;

use App\Memorize;
use Illuminate\Http\Request;

class MemorizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = [
            'memorizes' => Memorize::all(),
            'status' => 'success',
            'message' => 'get list'
        ];
        return $res;
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
        $idUser = $request->IdUser;
        $idVocabulary = $request->IdVocabulary;
        $content = $request->Content;
        if('' == $content){
            $res = [
                'status' => 'fail',
                'message' => 'Blank Content'
            ];
        }else{
            $memorize = new Memorize();
            $memorize->IdUser = $idUser;
            $memorize->IdVocabulary = $idVocabulary;
            $memorize->Content = $content;
            $memorize->save();
            $res = [
                'memorize' => $memorize,
                'status' => 'success',
                'message' => 'Created Successfully'
            ];

        }
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memorize = Memorize::find($id);
        if($memorize != null){
            $res = ['memorize' => $memorize,'status'=> 'success', 'message' => 'Find successfully'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Cannot find memorize'];

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
        $memorize = Memorize::find($id);
        if($memorize != null){
            $memorize->Content = $request->Content;
            $memorize->save();
            $res = [
                'memorize' => $memorize,
                'status' => 'success',
                'message' => 'Updated'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'Can not find'
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
    public function destroy($id)
    {
        $memorize = Memorize::find($id);
        if($memorize != null){
            $memorize->delete();
            $res = ['status'=> 'success', 'message' => 'Delete Success'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Can not find'];

        }
        return $res;
    }
    public function getListMemorize(Request $request){
        $idUser = $request->idUser;
        $memorizes = Memorize::where('IdUser','=',$idUser)
                                ->get();
        if (count($memorizes) > 0){
            $res = [
                'memorizes' => $memorizes,
                'status' => 'success',
                'message' => 'Finded'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'List Memorize is Empty'
            ];
        }
        return $res;
    }
}
