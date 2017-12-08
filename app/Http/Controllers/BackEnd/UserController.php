<?php

namespace App\Http\Controllers\BackEnd;

use App\BlockUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\FavouriteWord;
use App\Memorize;
use App\UserLearnt;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('isAdmin','=',0)
            ->orderBy('id','DESC')
            ->paginate(10);
        foreach ($users as $user){
            $blockUser = BlockUser::where('idUser','=',$user->id)->first();
            if($blockUser != null ) $user->isBlocked = true;
            else $user->isBlocked = false;
        }
        return view('backend.users.index')->with('users',$users);
    }

    public function show($id){
        $user = User::findOrFail($id);
        $blockUser = BlockUser::where('idUser','=',$id)->first();
        if($blockUser != null ){
            $user->idBlocked = true;
            $user->reason = $blockUser->reason;
        }else{
            $user->isBlocked = false;
        }
        return view('backend.users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.edit')->with('user',$user);
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
        $user = User::findOrFail($id);

        //Lay thong tin tu form
        if($request->password != null){
            if($request->password != $request->password_confirmation){
                $request->session()->flash('fail','Password and Password Confirm are not the same!');
                return redirect()->back();
            }
            $user->password = bcrypt($request->password);
        }

        if($user->save()) {
            $request->session()->flash('success', 'User was updated successfully!');
        }else{
            $request->session()->flash('fail', 'User was updated successfully!');
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if($user != null) {
            //xoa het cac thong tin lien quan toi user
            //UserLearnt
            UserLearnt::where('IdUser', '=', $user->id)
                ->delete();
            //Memorize
            Memorize::where('IdUser', '=', $user->id)
                ->delete();
            //Favourite
            FavouriteWord::where('IdUser', '=', $user->id)
                ->delete();
            $user->delete();
            //Xoa record trong database
            if ($user->delete()) {
                $request->session()->flash('success', 'User was deleted successfully!');
            } else {
                $request->session()->flash('success', 'User was deleted unsuccessfully!');
            }
        }
        return redirect()->route('users.index');
    }

    public function getBlockUser(Request $request){
        $user = User::findOrFail($request->idUser);
        return view('backend.users.block',compact('user'));
    }
    public function postBlockUser(Request $request)
    {
        $user = User::findOrFail($request->idUser);
        $blockUser = new BlockUser();
        $blockUser->idUser = $user->id;
        $blockUser->reason = $request->reason;
        $blockUser->save();
        return redirect()->route('users.index');
    }

    public function getUnLockUser(Request $request){
        $user = User::findOrFail($request->idUser);
        $blockUser = BlockUser::where('idUser','=',$user->id)->first();
        $blockUser->delete();
        return redirect()->route('users.index');
    }
    public function getProfile(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        return view('backend.users.profile', compact('user'));
    }

    public function putProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        //Lay thong tin tu form
        $user->name = $request->fullname;
        if($request->password != null){
            if($request->password != $request->password_confirmation){
                $request->session()->flash('fail','Password and Password Confirm are not the same!');
                return redirect()->back();
            }
            $user->password = bcrypt($request->password);
        }
        if($user->save()) {
            $request->session()->flash('success', 'Profile was updated successfully!');
        }else{
            $request->session()->flash('fail', 'Profile was updated successfully!');
        }
        return redirect()->route('profile');
    }
}
