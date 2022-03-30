<?php
namespace App\Helpers;
use App\Models\Setting;
use App\Models\User;

class UserHelper extends BaseHelper{
    public $user;

        /**
     * -------------------------------------------------------
     * | Create a new helper instance.                       |
     * |                                                     |
     * -------------------------------------------------------
    */
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
    }
    /**
     * -------------------------------------------------------
     * | Get User .                                          |
     * |                                                     |
     * | @return User                                        |
     * -------------------------------------------------------
    */
    public function getData($uuid=null){
        $user = $this->user::whereUuid($uuid)->first();
        return $user;
    }

    /**
     * -------------------------------------------------------
     * | Save or update admin record.                        |
     * |                                                     |
     * | @return Admin                                       |
     * -------------------------------------------------------
     */
    public function store($request,$id=null){
        $user = new User();
        $this->unsetRequestValue($request);
        if($id != null){
            $user = $this->user::firstOrNew(['uuid'=>$id]);
        }
        if(empty($user)){
            throw new \Exception(__('messages.not_found',['model'=> __('label.user') ]));
        }
        // update profile picture
        if($request->hasFile('avatar')){
            $user->attachment()->delete();
            $user->updateAttachment($request->avatar);
        }
        // remove profile picture
        if($request->avatar_remove == '1' && !$request->hasFile('avatar')){
            $user->attachment()->delete();
        }
        $request['status'] = $request->has('status')?$request->status:0;
        $request['email_verified_at'] = date('Y-m-d h:i:s');
        $user->fill($request->all())->save();
        return $user;
    }
}