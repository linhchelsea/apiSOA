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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $remember_token = $request->remember_token;
        $arr_idVoca = $request->idVocabularies;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        if($user == null ){
            return [
                'status' => 'fail',
                'message' => 'User not found'
            ];
        }
        //them vao bang
        $favouriteWords = array();
        for($i = 0; $i< count($arr_idVoca); $i++){
            $idVocabulary = intval($arr_idVoca[$i]);
            if(self::isNotExistWord($user->id,$idVocabulary)){
                $favouriteWord = new FavouriteWord();
                $favouriteWord->IdUser = $user->id;
                $favouriteWord->IdVocabulary = $idVocabulary;
                $favouriteWord->save();
                array_push($favouriteWords,$favouriteWord);
            }
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
    public function show(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        $idVocabulary = $request->idVocabulary;
        $favouriteWord = FavouriteWord::join('users','FavoriteWords.IdUser','=','users.id')
            ->join('Vocabulary','FavoriteWords.IdVocabulary','=','Vocabulary.Id')
            ->where('FavoriteWords.IdUser','=',$user->id)
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        $idVocabulary = $request->idVocabulary;
        $favoutireWord = FavouriteWord::where('IdUser','=',$user->id)
                                        ->where('IdVocabulary','=',$idVocabulary)
                                        ->delete();
        if($favoutireWord){
            $res = [
                'status' => 'success',
                'message' => 'This word was removed'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'Can not find your word'
            ];
        }

        return $res;
    }

    public function favouriteByUser(Request $request){
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        $favouriteWords = FavouriteWord::join('Users','FavoriteWords.IdUser','=','Users.Id')
                        ->join('Vocabulary','FavoriteWords.IdVocabulary','=','Vocabulary.Id')
                        ->where('IdUser','=',$user->id)
                        ->get();
        if (count($favouriteWords) > 0){
            $res = [
                'favouriteWords' => $favouriteWords,
                'status' => 'success',
                'message' => 'Find your words successfully'
            ];
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'There is no favourite words'
            ];
        }
        return $res;
    }
    public function isNotExistWord($idUser, $idVocabulary){
        $favourite = FavouriteWord::where('IdUser','=',$idUser)
            ->where('IdVocabulary','=',$idVocabulary)
            ->first();

        if($favourite != null){
            return false;
        }

        return true;
    }
}
