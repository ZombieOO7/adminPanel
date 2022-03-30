<?php

namespace App\Http\Controllers\Auth;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\AjaxResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin';
    protected $view = 'admin.admin.';

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * This is function is use for login form view.
     */
    public function showLoginForm()
    {
        $data['setting'] = Setting::first();
        return view($this->view.'login',$data);
    }

    /**
     * This function is used for login process.
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return AjaxResponseTrait::AllResponse(false,'info',$validator->errors());
        }
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => strtolower($request->email), 'password' => $request->password])) {
            if(Auth::guard('admin')->user()->email_verified_at == null){
                Auth::guard('admin')->logout();
                $msg = __('messages.email_not_verified');
                return AjaxResponseTrait::AllResponse(false,'error',$msg);
            }
            if(Auth::guard('admin')->user()->status == 0){
                Auth::guard('admin')->logout();
                $msg = __('messages.inactive_account');
                return AjaxResponseTrait::AllResponse(false,'error',$msg);
            }
            $msg = __('messages.login_success');
            $url = route('admin.dashboard');
            return AjaxResponseTrait::AllResponse(true,'success',$msg,null,$url);
        }
        $msg = __('messages.login_fail');
        return AjaxResponseTrait::AllResponse(true,'error',$msg);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
