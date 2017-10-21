<?php

namespace App\Http\Controllers;

use App\FavouriteWord;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class FavouriteWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favouriteWords = FavouriteWord::join('Users','FavoriteWords.IdUser','=','Users.Id')
            ->join('Vocabulary','FavoriteWords.IdVocabulary','=','Vocabulary.Id')
            ->get();
        $res = [
            'favouriteWords' => $favouriteWords,
            'status'=> 'success',
            'message' => 'Get list of favouriteWord'
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
        $data = json_decode($request->data);
        $idUser = intval($data->iduser);
        $user = User::find($idUser);
        if($user == null ){
            return [
                'status' => 'fail',
                'message' => 'User not found'
            ];
        }
        $arr_idVoca = $data->idvoca;
        //them vao bang
        $favouriteWords = array();
        for($i = 0; $i< count($arr_idVoca); $i++){
            $favouriteWord = new FavouriteWord();
            $favouriteWord->IdUser = $idUser;
            $favouriteWord->IdVocabulary = intval($arr_idVoca[$i]);
            $favouriteWord->save();
            array_push($res,$favouriteWord);
        }
        $res = [
            'favouriteWords' => $favouriteWords,
            'status'=> 'success',
            'message' => 'Create favouriteWord successfully'
        ];
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idUser,$idVocabulary)
    {
        $favouriteWord = FavouriteWord::join('Users','FavoriteWords.IdUser','=','Users.Id')
            ->join('Vocabulary','FavoriteWords.IdVocabulary','=','Vocabulary.Id')
            ->where('FavoriteWords.IdUser','=',$idUser)
            ->where('FavoriteWords.IdVocabulary','=',$idVocabulary)
            ->first();
        if($favouriteWord != null){
            $res = ['favouriteWord' => $favouriteWord,'status'=> 'success', 'message' => 'Find successfully'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Cannot find favouriteWord'];

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

    public function favouriteByUser(Request $request){
        $idUser = $request->idUser;
        $favouriteWords = FavouriteWord::join('Users','FavoriteWords.IdUser','=','Users.Id')
                        ->join('Vocabulary','FavoriteWords.IdVocabulary','=','Vocabulary.Id')
                        ->where('IdUser','=',$idUser)
                        ->get();
        if (count($favouriteWords) > 0){
            $res = [
                'favouriteWords' => $favouriteWords,
                'status' => 'success',
                'message' => 'Finded'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'List is Empty'
            ];
        }
        return $res;
    }
}
