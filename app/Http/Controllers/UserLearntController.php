<?php

namespace App\Http\Controllers;

use App\User;
use App\UserLearnt;
use Illuminate\Http\Request;

class UserLearntController extends Controller
{
   public function updatePoint(Request $request){
        $idUser = $request->idUser;
        $user = User::find($idUser);
        if ($user != null){
            $idLesson = $request->idLesson;
            $point = $request->point;
//            //cap nhat total point cua user
            $userLearnt = UserLearnt::where('IdUser','=',$idUser)
                ->where('IdLesson','=',$idLesson)
                ->first();
            if($userLearnt != null){
                if($userLearnt->LessonPoint < $point){
                    $userLearnt = UserLearnt::where('IdUser','=',$idUser)
                        ->where('IdLesson','=',$idLesson)
                        ->update(['LessonPoint' => $point]);
                }
                $userLearnt = UserLearnt::where('IdUser','=',$idUser)
                    ->where('IdLesson','=',$idLesson)
                    ->first();
                $res = [
                    'userLearnt' => $userLearnt,
                    'status' => 'success',
                    'message' => 'updated'
                ];
            }else{
                $userLearnt = new UserLearnt();
                $userLearnt->IdUser = $idUser;
                $userLearnt->IdLesson = $idLesson;
                $userLearnt->LessonPoint = $point;
                $userLearnt->save();
                $res = [
                    'userLearnt' => $userLearnt,
                    'status' => 'success',
                    'message' => 'created'
                ];
            }
        }else{
            $res = [
                'status' => 'fail',
                'message' => 'User is not exist'
            ];
        }

       return $res;
   }
}
