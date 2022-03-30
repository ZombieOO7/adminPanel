<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        if($request->is('admin')){
            if (Auth::guard('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }else{
                return redirect()->route('admin.login');
            }
        }else{
            return view('welcome');
        }
    }
}
