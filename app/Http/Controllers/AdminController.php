<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a login view.
     *
     *
     */
    public function login()
    {
        return view('admin.admin_login');
    }

    /*
     * store login info.
     *
     * @param Request $request
     */
    public function loginStore(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->input();
            if (Auth::attempt([ 'email'=>$data['username'], 'password'=>$data['password'], 'admin'=>'1' ])){

                return redirect('admin/dashboard');
            }else{

                return redirect('/admin')->with('error', 'Incorrect Username or Password');
            }
        }

    }

    /**
     * return dashboard view.
     *
     *
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Logout from admin.
     *
     *
     */
    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('error', 'Logged Out Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
