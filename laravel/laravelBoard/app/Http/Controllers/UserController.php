<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * 로그인 페이지로 이동
     */
    public function goLogin() {
        return view('login');
    }

    /**
     * 로그인 처리
     */
    public function login(Request $request) {
        Log::debug('리퀘스트 데이터', $request->only('u_email', 'u_password'));
        // 유효성 체크
        $validator = Validator::make(
            $request->only('u_email', 'u_password')
            ,[
                'u_email' => ['required', 'email', 'exists:users,u_email']
                ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
            ]
        );

        if($validator->fails()) {
            return redirect()
                    ->route('goLogin')
                        ->withErrors($validator->errors());
        }

        // 회원 정보 획득
        $userInfo = User::where('u_email', '=', $request->u_email)->first();

        // 비밀번호 체크
        if(!(Hash::check($request->u_password, $userInfo->u_password))) {
            return redirect()->route('goLogin')->withErrors('비밀번호가 일치하지 않습니다.');
        }

        // 유저 인증 처리
        Auth::login($userInfo); // 이렇게 하면 로그인 끝
        // var_dump(Auth::id()); // 로그인한 유저의 pk 획득
        // var_dump(Auth::user()); // 로그인한 유저의 정보 획득
        // var_dump(Auth::check()); // 로그인 여부 체크

        return redirect()->route('boards.index');
    }
    /**
     * 로그아웃 처리
     */
    public function logout() {
        Auth::logout(); // 로그아웃 처리

        Session::invalidate(); // 기존 세션의 모든 데이터 제거 및 새로운 세션 ID 발급
        Session::regenerateToken(); // CSRF 토큰 재발급

        return redirect()->route('goLogin');
    }
}