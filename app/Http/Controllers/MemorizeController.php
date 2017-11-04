<?php

namespace App\Http\Controllers;

use App\Memorize;
use App\User;
use App\Vocabulary;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        if($user == null){
            return response()->json([
                'status' => 'fail',
                'message' => 'User is not existed!'
            ]);
        }
        $idVocabulary = $request->IdVocabulary;
        $vocabulary = Vocabulary::find($idVocabulary);
        if($vocabulary == null){
            return response()->json([
                'status' => 'fail',
                'message' => 'Word is not existed!'
            ]);
        }
        $content = $request->Content;
        if('' == $content){
            $res = [
                'status' => 'fail',
                'message' => 'Blank Content'
            ];
        }else{
            $memorize = new Memorize();
            $memorize->IdUser = $user->id;
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
    public function show(Request $request)
    {
        $id = $request->id;
        $memorize = Memorize::find($id);
        if($memorize != null){
            $res = ['memorize' => $memorize,'status'=> 'success', 'message' => 'Find successfully'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Cannot find memorize'];

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
        $content = $request->Content;
        if($content == ''){
            return response()->json([
                'status' => 'fail',
                'message' => 'Blank Content!'
            ]);
        }
        $memorize = Memorize::find($id);
        if($memorize != null){
            $memorize->Content = $content;
            $memorize->save();
            $res = [
                'memorize' => $memorize,
                'status' => 'success',
                'message' => 'Updated'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'This memorization is not exist!'
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
    public function destroy(Request $request)
    {
        $id = $request->id;
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
        $remember_token = $request->remember_token;
        $idVocabulary = $request->idVocabulary;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        if($user == null){
            return response()->json([
                'status' => 'fail',
                'message' => 'User is not existed!'
            ]);
        }
        $memorizes = Memorize::where('IdUser','=',$user->id)
                                ->where('IdVocabulary','=',$idVocabulary)
                                ->select('Id','Content')
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
