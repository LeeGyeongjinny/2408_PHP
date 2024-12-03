<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'account' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
            ,'password' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
        ];

        if($this->routeIs('auth.login')) {
            // 로그인
            $rules['account'][] = 'exists:users,account';
        } else if($this->routeIs('user.store')){
            // 회원가입
            $rules['account'][] = 'unique:users,account';
            $rules['password_chk'] = ['same:password']; // 기존의 password와 동일한지만 체크
            $rules['name'] = ['required', 'between:1, 20', 'regex:/^[가-힣]+$/u'];
            $rules['gender'] = ['required', 'regex:/^[0-1]{1}$/']; // {1} : 1글자만 올 수 있다 
            $rules['profile'] = ['required', 'image']; // max:2 추가 : megabyte로 최대크기 지정
        }
        
        return $rules;
    } // validation에 적었던 방식 그대로 적으면 됨

    protected function failedValidation(Validator $validator) {
        $response = response()->json([
            'success' => false,
            'message' => '유효성 체크 오류',
            'data' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    } // 실패했을 때 json형태로 메시지 보내줌
}
