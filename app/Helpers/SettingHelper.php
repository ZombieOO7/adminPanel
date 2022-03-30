<?php
namespace App\Helpers;
use App\Models\Setting;

class SettingHelper extends BaseHelper{
    public $setting;

    /**
     * -------------------------------------------------------
     * | Create a new helper instance.                       |
     * |                                                     |
     * -------------------------------------------------------
    */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        parent::__construct();
    }
    /**
     * -------------------------------------------------------
     * | Get Setting .                                       |
     * |                                                     |
     * | @return Setting                                     |
     * -------------------------------------------------------
    */
    public function getData(){
        $setting = $this->setting::first();
        return $setting;
    }

    /**
     * -------------------------------------------------------
     * | Save or update admin record.                        |
     * |                                                     |
     * | @return Admin                                       |
     * -------------------------------------------------------
     */
    public function store($request,$id=null){
        $setting = new Setting();
        $this->unsetRequestValue($request);
        if($id != null){
            $setting = $this->setting::firstOrNew(['uuid'=>$id]);
        }
        if(empty($setting)){
            throw new \Exception(__('messages.not_found',['model'=> __('label.setting') ]));
        }
        // update profile picture
        if($request->hasFile('avatar')){
            $setting->attachment()->delete();
            $setting->updateAttachment($request->avatar);
        }
        // remove profile picture
        if($request->avatar_remove == '1' && !$request->hasFile('avatar')){
            $setting->attachment()->delete();
        }
        $setting->fill($request->all())->save();
        return $setting;
    }
}