<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\didTask;

class ProfileController extends Controller
{
    //
    public function index(){
        $users=User::all();
        return view('profile.index',compact('users'));
    }

    public function edit(User $user){
        $this->authorize('update',$user);
        $roles=Role::all();
        return view('profile.edit',compact('user','roles'));
    }

    public function update(User $user, Request $request){
        $this->authorize('update',$user);

        $inputs=request()->validate([
            'name'=>'required|max:255',
            'email'=>['required','email','max:255',Rule::unique('users')->ignore($user->id)],
            'password'=>'required|confirmed|max:255|min:8',
            'password_confirmation'=>'required|same:password',
        ]);
        $inputs['password']=Hash::make($inputs['password']);
        $user->update($inputs);
        return back()->with('message','ユーザー情報を更新しました');

    }

    public function delete(User $user){
        $user->roles()->detach();
        didTask::where('user_id',$user->id)->delete();
        $user->delete();
        return back()->with('message','ユーザーを削除しました');
    }


}
