<?php

namespace App\Http\Controllers;

use App\FavouriteWord;
use App\Lesson;
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
            $user->setRememberToken(self::randomRememberToken());
            $user->save();
            //Them bai 1-2-3 trong user learnt
            self::createFirstThreeLessons($user->id);
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
    public function show(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
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
    public function update(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
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
    public function delete(Request $request)
    {
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        if($user != null){
            //xoa het cac thong tin lien quan toi user
            //UserLearnt
            UserLearnt::where('IdUser','=',$user->id)
                                ->delete();
            //Memorize
            Memorize::where('IdUser','=',$user->id)
                                ->delete();
            //Favourite
            FavouriteWord::where('IdUser','=',$user->id)
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
            return response()->json([
                'status' => 'Success',
                'token' => Auth::user()->getRememberToken()
            ]);
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function logout(Request $request){
        $remember_token = $request->remember_token;
        $user = User::where('remember_token','=',$remember_token)
            ->first();
        if(!$user){
            $res = [
                'status' => 'fail',
                'message' => 'Can not find User'
            ];
        }else {
            $user->setRememberToken(self::randomRememberToken());
            $user->save();
            $res = [
                'status' => 'success',
                'message' => 'Logout successfully'
            ];
        }
        return response()->json($res);
    }
    public static function createFirstThreeLessons($idUser){
        //lay 3 bai dau tien trong danh sach lesson
        $Lessons = Lesson::where('Id','<>',0)
                            ->orderBy('Id','ASC')
                            ->limit(3)
                            ->get();
        foreach ($Lessons as $Lesson){
            $userLearnt = new UserLearnt();
            $userLearnt->IdUser = $idUser;
            $userLearnt->IdLesson = $Lesson->Id;
            $userLearnt->LessonPoint = 0;
            $userLearnt->save();
        }
    }
    public static function randomRememberToken(){
        $arrCharacters = ['a','b','c','d','e','f','g','h','i','j','k','l','m'
                        ,'n','o','p','q','r','s','t','u','v','w','x','y','z'
                        ,'A','B','C','D','E','F','G','H','I','J','K','L','M'
                        ,'N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
                        ,'0','1','2','3','4','5','6','7','8','9'];
        $remember_token = '';
        for ($i = 1 ; $i <= 60; $i++){
            $index = rand(0,count($arrCharacters)-1);
            $remember_token = $remember_token .''.$arrCharacters[$index];
        }
        return $remember_token;
    }
}
