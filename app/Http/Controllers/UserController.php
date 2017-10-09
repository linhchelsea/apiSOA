<?php

namespace App\Http\Controllers;

use App\FavouriteWord;
use App\Memorize;
use App\User;
use App\UserLearnt;
use Illuminate\Http\Request;
use Psy\Util\Json;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(self::checkUsername($request->username)==null){
            $user = new User();
            $user->Username = $request->username;
            $user->Password = $request->password;
            $user->Password = bcrypt($user->password);
            $user->Fullname = $request->fullname;
            $user->Email = $request->email;
            $user->Level = $request->level;
            $user->TotalPoint = 0;
            $user->save();
            return $user;
        }
        return response()->json('Username was existed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user != null){
            $res = ['user' => $user,'status'=> 'success', 'message' => 'Find successfully'];
        }else{
            $res = ['status'=> 'fail', 'message' => 'Cannot find user'];

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
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user != null){
            if(''!= $request->password){
                $user->Password = bcrypt($request->password);
            }
            $user->Fullname = $request->fullname;
            $user->Email = $request->email;
            $user->Level = $request->level;
            $user->save();
            $res = [
                'user' => $user,
                'status' => 'success',
                'message' => 'Updated'
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);
        if($user != null){
            //xoa het cac thong tin lien quan toi user
            //UserLearnt
            UserLearnt::where('IdUser','=',$id)
                                ->delete();
            //Memorize
            Memorize::where('IdUser','=',$id)
                                ->delete();
            //Favourite
            FavouriteWord::where('IdUser','=',$id)
                                ->delete();
            $user->delete();
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
    public function checkUsername($username){
        $user = User::where('Username','=',$username)->first();
        return $user;
    }
}
