<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Hash;
use Session;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show_update_password(){
        return view('update-password.edit');
    }
    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => "required",
            'new_password' => 'required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        $id = Auth::id();


        if((!empty($_POST['old_password'])) && (!empty($_POST['new_password'])) && (!empty($_POST['confirm_password']))){
            if($_POST['new_password'] == $_POST['confirm_password']){
                $current_password = Auth::user()->password;

                $user = User::find($id);
                if (Hash::check($request->input('old_password'), $user->password)) {
                    $user = User::find($id);
                    $user->password = Hash::make($request->input("new_password"));
                    $user->save();
                    Session::flash('success','Password successfully updated.');
                }else{
                    Session::flash('error','Old passowrds is not correct.');
                }
            }else{
                Session::flash('error','Passowrds do not match.');
            }
        }
        return back();
    }
}
