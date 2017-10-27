<?php

namespace App\Http\Controllers;

use App\FavouriteWord;
use App\Memorize;
use App\User;
use App\UserLearnt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Psy\Util\Json;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = [
            'users' => User::all(),
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
        if(self::checkEmail($request->email)==null){
            $user = new User();
            $user->name = $request->name;
            $user->password = $request->password;
            $user->password = bcrypt($user->password);
            $user->email = $request->email;
            $user->level = 1;
            $user->save();
            $res = [
                'user' => $user,
                'status' => 'success',
                'message' => 'Create new user successfully'
            ];
            return $res;
        }
        $res = [
            'status' => 'fail',
            'message' => 'Email was existed'
        ];
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
                $user->password = bcrypt($request->password);
            }
            $user->name = $request->name;
            $user->level = $request->level;
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
    public function checkEmail($email){
        $user = User::where('email','=',$email)->first();
        return $user;
    }
    public function postLogin(Request $request){
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($login)){
            session_start();
            Session::put('userLogin', Auth::user());
            return response()->json([
                'status' => 'Success',
//                'token' => Auth::user()->getRememberToken()
                'token' => Session::get('userLogin')
            ]);
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function logout(Request $request){
        return $request->url('/logout');
        $res = [
          'status' => 'success',
          'message' => 'Logout successfully'
        ];
        return response()->json($res);
    }
}
