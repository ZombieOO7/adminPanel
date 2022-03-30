<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use App\Traits\AjaxResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $validator = [
            'name' => 'required|max:'.config('validation.input_max_length'),
            'email' => "required|email|unique:users,email,$request->id",
        ];
        if($request->password != null){
            $validator['password'] = 'required|max:'.config('validation.password_max_length').'|min:'.config('validation.password_min_length');
            $validator['confirm_password'] = 'required|same:password|max:'.config('validation.password_max_length').'|min:'.config('validation.password_min_length');
        }
        return $validator;
    }

    /**
    * Get the error messages for the defined validation rules.*
    * @return array
    */
    protected function failedValidation(Validator $validator)
    {
        $route = 'admin.user.create';
        if($validator->fails()){
            $response = AjaxResponseTrait::RedirectResponse('errors',$route,$validator->errors(),$this->uuid);
        }
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
