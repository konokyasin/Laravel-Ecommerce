<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userLoginRegister()
    {
        return view('wayshop.users.login_register');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $userCount = User::where('email', $data['email'])->count();
        if($userCount>0)
        {
            return redirect()->back()->with('error', 'User is already exists!!! ');
        }else{
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

                Session::put('frontSession', $data['email']);

                return redirect('/cart');
            }
        }
    }

    public function logout()
    {
        Session::forget('frontSession');
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            Session::put('frontSession', $data['email']);

            return redirect('/cart');
        } else {

            return redirect()->back()->with('error', 'Incorrect Username or Password');
        }
    }

    public function account()
    {
        return view('wayshop.users.account');
    }

    public function changePassword()
    {
        return view('wayshop.users.change_password');
    }

    public function storePassword(Request $request)
    {
        $data = $request->all();
        $old_pwd = User::where('id', Auth::User()->id)->first();
        $current_password = $data['current_password'];
        if (Hash::check($current_password, $old_pwd->password)) {
            $new_pwd = bcrypt($data['new_pwd']);
            User::where('id', Auth::User()->id)->update(['password' => $new_pwd]);
            return redirect()->back()->with('working', 'Yours Password is Changed Now!!');
        } else {
            return redirect()->back()->with('error', 'Old Password is Incorrect!!');
        }
    }

    public function changeAddress()
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::all();
        return view('wayshop.users.change_address', compact('countries', 'userDetails'));
    }

    public function storeAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $user = User::find($user_id);
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        $user->pincode = $data['pincode'];
        $user->mobile = $data['mobile'];
        $user->save();
        return redirect()->back()->with('working', 'Account Details Has Been Updated!!');

    }
}
