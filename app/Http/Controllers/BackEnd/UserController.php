<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\FavouriteWord;
use App\Memorize;
use App\UserLearnt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')
            ->paginate(10);
        return view('backend.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->isAdmin = 0;
        //kiem tra email co bi trong khong
        $user_checkEmail = User::where('email','=',$user->email)->first();
        if($user_checkEmail != null){
            $request->session()->flash('fail', 'Email was used by another user');
            return redirect()->back();
        }
        $user->password = bcrypt($request->password);
        $user->level = 1;
        $user->setRememberToken(app('App\Http\Controllers\UserController')->randomRememberToken());
        if($user->save()) {
            $request->session()->flash('success', 'New user was created successfully!');
        }else{
            $request->session()->flash('fail', 'New user was created unsuccessfully!');
        }
        //Them bai 1-2-3 trong user learnt
        app('App\Http\Controllers\UserController')->createFirstThreeLessons($user->id);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $user->name = $request->fullname;
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
}
