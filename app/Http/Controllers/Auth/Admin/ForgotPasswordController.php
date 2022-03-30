<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Traits\AjaxResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Admin;
use Exception;

class ForgotPasswordController extends BaseController
{
    protected $view = 'admin.admin.';
    public $helper;
    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(AdminHelper $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }

    /**
     * -------------------------------------------------------
     * | Reset Password Page.                                |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function index()
    {
        return view($this->view.'forgot_password');
    }

    /**
     * -------------------------------------------------------
     * | Reset Password Page.                                |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
        ],[
            'email.exists' => __('messages.not_exist',['model'=> __('label.email')]),
        ]);
        if($validator->fails()){
            return AjaxResponseTrait::AllResponse(false,'info',$validator->errors());
        }
        $this->dbStart();
        try {
            $adminResetToken = $this->helper->sendResetLink($request);
            if(!empty($adminResetToken)){
                $this->dbCommit();
                $msg = __('messages.reset_link_sent');
                return AjaxResponseTrait::AllResponse(true,'success',$msg,null);
            }
            return AjaxResponseTrait::AllResponse(false,'error',__('messages.try_again'));
        }catch (\Exception $e){
            $this->dbEnd();
            return AjaxResponseTrait::AllResponse(false,'error',$e->getMessage());
        }
    }

    /**
     * -------------------------------------------------------
     * | Reset New Password Page.                            |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function showResetForm($token=null)
    {
        try{
            $data['token'] = $token;
            // $this->helper->verifyToken($token);
            return view($this->view.'reset_password',$data);
        }catch(Exception $e){
            return redirect()->route('admin.reset-password')->with(['message'=>$e->getMessage()]);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required|max:'.config('validation.password_max_length').'|min:'.config('validation.password_min_length'),
            'confirm_password' => 'sometimes|same:password|max:'.config('validation.password_max_length').'|min:'.config('validation.password_min_length'),
        ]);
        if($validator->fails()){
            return AjaxResponseTrait::AllResponse(false,'info',$validator->errors());
        }
        $this->dbStart();
        try {
            $token = $this->helper->verifyToken($request->token);
            $admin = $this->helper->findByMail($token->email);
            $this->helper->store($request,$admin->id);
            $this->dbCommit();
            $msg = __('messages.password_updated');
            $url = route('admin.login');
            return AjaxResponseTrait::AllResponse(true,'success',$msg,null,$url);
        }catch (\Exception $e){
            $this->dbEnd();
            return AjaxResponseTrait::AllResponse(false,'error',$e->getMessage());
        }
    }
}
