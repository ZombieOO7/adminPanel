<?php
namespace App\Helpers;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Notifications\SendAdminPasswordResetMail;

class AdminHelper extends BaseHelper{
    public $user;
    /**
     * -------------------------------------------------------
     * | Create a new helper instance.                       |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(Admin $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * -------------------------------------------------------
     * | Save or update admin record.                        |
     * |                                                     |
     * | @return Admin                                       |
     * -------------------------------------------------------
     */
    public function store($request,$id=null){
        $user = new Admin();
        $this->unsetRequestValue($request);
        if($id != null){
            $user = $this->user::find($id);
        }
        if(empty($user)){
            throw new \Exception(__('messages.not_found',['model'=> __('label.profile') ]));
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
        $user->fill($request->all())->save();
        return $user;
    }

    /**
     * -------------------------------------------------------
     * | Save or update admin record.                        |
     * |                                                     |
     * | @return Admin                                       |
     * -------------------------------------------------------
     */
    public function sendResetLink($request){
        $user = Admin::where('email', $request->email)->first();
        if (empty($user)){
            throw new \Exception(__('messages.not_exist',['model'=> __('label.email') ]));
        }
        // generate token
        $token = (string) Str::uuid();
        // delete old tokens
        DB::table('admin_password_resets')->orWhere('email', $user->email)->delete();
        // store token
        $adminResetToken = DB::table('admin_password_resets')->insert([
                                'email'=>$request->email,
                                'token'=> $token,
                                'created_at'=> now()
                            ]);
        $user->notify(new SendAdminPasswordResetMail($token));
        return $adminResetToken;
    }

    /**
     * -------------------------------------------------------
     * | Verify that token is not expired.                   |
     * |                                                     |
     * | @return Admin                                       |
     * -------------------------------------------------------
     */
    public function verifyToken($token){
        $token = DB::table('admin_password_resets')->where(['token'=>@$token])->first();
        if($token){
            return $token;
        }else{
            throw new \Exception(__('messages.token_expired'));
        }
        return;
    }

    /**
     * -------------------------------------------------------
     * | Find admin by email.                                |
     * |                                                     |
     * | @return Admin                                       |
     * -------------------------------------------------------
     */
    public function findByMail($email){
        $admin = Admin::whereEmail($email)->first();
        if($admin){
            return $admin;
        }else{
            throw new \Exception(__('messages.not_found',['model'=>__('label.admin')]));
        }
        return;
    }
}
?>