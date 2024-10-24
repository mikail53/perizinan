<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index() 
    {

        return view('login');

    }
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'email wajib diisi',
            'password.required'=>'password wajib diisi'
        ]);

         $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
         ];

         if(Auth::attempt($infologin)){
           if(Auth::user()->role == 'operator'){
            return redirect('admin/operator');
         } elseif(Auth::user()->role == 'koordinator'){
            return redirect('admin/koordinator');
         }
         }else{
            return redirect('')->withErrors('username dan password yang dimasukan tidak sesuai')->withInput();
         }

    }


    function logout()
    {
     Auth::logout();
      return redirect('');
    }
}
