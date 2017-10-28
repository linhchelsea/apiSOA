<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\UserLearnt;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class UserLearntController extends Controller
{
   public function updatePoint(Request $request){
        $remember_token = $request->remember_token;
        $idLesson = $request->idLesson;
        $point = $request->point;
        if($point > 5){
            return response()->json([
                'status' => 'fail',
                'message' => 'Point is invalid'
            ]);
        }
        $user = User::where('remember_token','=',$remember_token)
           ->first();
        if ($user != null){
//            //cap nhat total point cua user
            $userLearnt = UserLearnt::where('IdUser','=',$user->id)
                ->where('IdLesson','=',$idLesson)
                ->first();
            if($userLearnt != null){
                if($userLearnt->LessonPoint < $point){
                    $userLearnt = UserLearnt::where('IdUser','=',$user->id)
                        ->where('IdLesson','=',$idLesson)
                        ->update(['LessonPoint' => $point]);
                }
                $userLearnt = UserLearnt::where('IdUser','=',$user->id)
                    ->where('IdLesson','=',$idLesson)
                    ->first();
                //kiem tra xem 3 bai hoc da pass het chua
                $beCanOpenNextThreeLessons = self::beCanOpenNextThreeLessons($user->id);
                $isFullLesson = self::isFullLesson($user->id);
                if($beCanOpenNextThreeLessons && !$isFullLesson){
                    //mo 3 bai hoc tiep theo
                    self::OpenNextThreeLessons($user->id);
                }
                $res = [
                    'userLearnt' => $userLearnt,
                    'status' => 'success',
                    'message' => 'updated'
                ];
            }else{
                $res = [
                    'status' => 'fail',
                    'message' => 'This lesson is blocked to you'
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
   public static function getThreeLessons($idUser){
       //lay 3 bai hoc gan nhat
       $userLearnts = UserLearnt::where('IdUser','=',$idUser)
           ->orderBy('IdLesson','DESC')
           ->limit(3)
           ->get();
       return $userLearnts;
   }
   public function beCanOpenNextThreeLessons($idUser){
       $userLearnts = self::getThreeLessons($idUser);
       $open = true;
       foreach ($userLearnts as $userLearnt){
           if ($userLearnt->LessonPoint < 4 ) $open = false;
       }
       return $open;
   }
   public function isFullLesson($idUser){
       $lessonQuantity = UserLearnt::where('IdUser','=',$idUser)
           ->count('IdLesson');
       if ($lessonQuantity === 50) return true;
       return false;
   }
   public function OpenNextThreeLessons($idUser){
       //lay id cua bai hoc gan nhat
       $idLesson = UserLearnt::where('IdUser','=',$idUser)
           ->orderBy('IdLesson','DESC')
           ->limit(1)
           ->select('IdLesson')
           ->get();

       //lay id 3 bai hoc tiep theo
       $idLessons = Lesson::where('Id','>', $idLesson[0]->IdLesson )
                            ->limit(3)
                            ->select('Id')
                            ->get();
       $arr_Id = array();
       foreach ($idLessons as $lesson){
           array_push($arr_Id, $lesson->Id);
       }
       foreach ($arr_Id as $id){
           $userLearnt = new UserLearnt();
           $userLearnt->IdUser = $idUser;
           $userLearnt->IdLesson = $id;
           $userLearnt->LessonPoint = 0;
           $userLearnt->save();
       }
    }
}
