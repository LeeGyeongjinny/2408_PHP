<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

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

    /**
     * 회원가입 - 실습 -----------------------------------------
     */
    // public function goRegist() {
    //     return view('regist');
    // }

    // public function regist(Request $request) {
    //     // 유효성 체크
    //     $validator = Validator::make(
    //         $request->only('u_email', 'u_password','u_password_chk','u_name')
    //         ,[
    //             'u_email' => ['required', 'email', 'unique:users,u_email']
    //             ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
    //             ,'u_password_chk' => ['required', 'between:6,20', 'same:u_password']
    //             ,'u_name' => ['required']
    //         ]
    //     );

    //     if($validator->fails()) {
    //         return redirect()
    //                 ->route('regist')
    //                     ->withErrors($validator->errors())
    //                     ->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {
    //         User::create([
    //             'u_email' => $request->u_email
    //             ,'u_password' => Hash::make($request->u_password)
    //             ,'u_name' => $request->u_name
    //         ]);

    //         DB::commit();
    //     } catch(Throwable $th) {
    //          DB::rollBack();
    //     }

    //     return redirect()->route('goLogin');
    // }

    // -----------------------------------
    /**
     * 회원가입 페이지로 이동 처리
     */
    public function registration() {
        return view('registration');
    }

    /**
     * 회원가입 처리
     */
    public function storeRegistration(Request $request) {
        // 유효성 체크
        $validator = Validator::make(
            $request->only('u_email', 'u_password', 'u_password_chk', 'u_name')
            ,[
                'u_email' => ['required', 'email', 'unique:users,u_email']
                ,'u_password' => ['required', 'between:6,20', 'regex:/^[a-zA-Z0-9!@]+$/']
                ,'u_password_chk' => ['same:u_password'] // u_password랑 동일하기만 하면 됨 (다른 체크 필요없음)
                ,'u_name' => ['required', 'between:2,50', 'regex:/^[가-힣]+$/u']
            ]
        );

        if($validator->fails()) {
            return redirect()
                    ->route('get.registration')
                        ->withErrors($validator->errors())
                        ->withInput();
        }

        // 회원 정보 삽입 처리
        // $user = new User();
        // $user->u_email = $request->u_email;
        // $user->u_password = Hash::make($request->u_password);
        // $user->u_name = $request->u_name;
        // $user->save();
        
        try {
            DB::beginTransaction();
            User::create([
                'u_email' => $request->u_email
                ,'u_password' => Hash::make($request->u_password)
                ,'u_name' => $request->u_name
            ]);
            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack(); // 이 메소드에서 inTransaction 자동으로 하기 때문에 체크할 필요 없다
        }

        return redirect()->route('goLogin');
    }
}