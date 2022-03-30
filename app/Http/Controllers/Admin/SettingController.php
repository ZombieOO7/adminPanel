<?php

namespace App\Http\Controllers\Admin;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\SettingHelper;
use App\Traits\AjaxResponseTrait;
use Illuminate\Support\Facades\Validator;

class SettingController extends BaseController
{
    public $helper,$view='admin.setting.';
    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(SettingHelper $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }

    /**
     * -------------------------------------------------------
     * | Get Setting  Page Data.                             |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function index(Request $request){
        try{
            $setting = $this->helper->getData();
            $data['title'] = __('label.setting');
            $data['setting'] = @$setting;
            return view($this->view.'index',$data);
        }catch(Exception $e){
            abort('404');
        }
    }

    /**
     * -------------------------------------------------------
     * | Get Store Setting Page Data.                        |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function store(Request $request,$id=null){
        $route = 'admin.setting';
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:'.config('validation.input_max_length'),
            'title' => 'required|max:'.config('validation.input_max_length'),
            'copyright' => 'required|max:'.config('validation.input_max_length'),
        ]);
        if($validator->fails()){
            return AjaxResponseTrait::RedirectResponse('errors',$route,$validator->errors());
        }
        $this->dbStart();
        try{
            $this->helper->store($request,$id);
            $this->dbCommit();
            $msg = __('messages.profile_save');
            $url = route('admin.profile');
            return AjaxResponseTrait::RedirectResponse('success',$route,$msg);
        }catch(Exception $e){
            $this->dbEnd();
            return AjaxResponseTrait::RedirectResponse('success',$route,$e->getMessage());
        }
    }
}
