<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\AjaxResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdminResource;
use Exception;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    public $user,$helper,$view='admin.admin.';
    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(Admin $user,AdminHelper $helper)
    {
        $this->user = $user;
        $this->helper = $helper;
        parent::__construct();
    }
    /**
     * -------------------------------------------------------
     * | Get Admin Profile Page.                             |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function index(Request $request){
        try{
            $admin = Admin::with(['attachment'])->find(Auth::guard('admin')->id());
            $data['title'] = __('label.profile');
            $data['admin'] = @$admin;
            return view($this->view.'profile',$data);
        }catch(Exception $e){
            abort('404');
        }
    }

    /**
     * -------------------------------------------------------
     * | Store Admin Profile.                                |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function store(Request $request){
        $user = Auth::guard('admin')->user();
        $id = @$user->id;
        $this->helper->unsetRequestValue($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.@$id??'NULL'.',id,deleted_at,NULL'.$id,
            'password' => 'sometimes|max:'.config('validation.password_max_length').'|min:'.config('validation.password_min_length'),
            'confirm_password' => 'sometimes|same:password|max:'.config('validation.password_max_length').'|min:'.config('validation.password_min_length'),
        ]);
        if($validator->fails()){
            return AjaxResponseTrait::AllResponse(false,'info',$validator->errors());
        }
        $this->dbStart();
        try{
            $this->helper->store($request,$id);
            $this->dbCommit();
            $msg = __('messages.profile_save');
            $url = route('admin.profile');
            return AjaxResponseTrait::AllResponse(true,'success',$msg,null,$url);
        }catch(Exception $e){
            $this->dbEnd();
            return AjaxResponseTrait::AllResponse(false,'error',$e->getMessage());
        }
    }
}
