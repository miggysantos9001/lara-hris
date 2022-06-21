<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Category;
use App\Employee_status;
use DB;
use Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'email'         =>  'required',
            'password'      =>  'required',
        ],
        [
            'email.required'        =>  'Email Required',
            'password.required'     =>  'Password Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password'), 'isActive' => 0])) {
            return redirect()->route('dashboard.index');
        }else{
            Alert::error('Warning', 'Login Credentials Not Found');
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
