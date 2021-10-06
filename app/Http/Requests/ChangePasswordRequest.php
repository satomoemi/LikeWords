<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
    public function rules()
    {
        return [
            'CurrentPassword' => ['required', 'string', 'min:8'],
            'newPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function withValidator(Validator $validator) {
        $validator->after(function ($validator) {
            $user_edit = Auth::user();
            //現在のパスワードと新しいパスワードが合わなければエラー
            if (!(Hash::check($this->input('CurrentPassword'), $user_edit->password))) {
                $validator->errors()->add('CurrentPassword', __('現在のパスワードが間違っています'));
            }
            if(!$this->input('newPassword') === $this->input('newPassword_confirmation') ){
                $validator->errors()->add('newPassword', __());
            }
        });
}

}
