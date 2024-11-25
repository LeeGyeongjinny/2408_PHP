<?php

namespace App\Utils;

use MyEncrypt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDOException;

class MyToken {
    /**
     * Access Token & Refresh Token 생성
     * 
     * @param  App\Models\User $user
     * @return  Array [$accessToken, $refreshToken]
     */

    public function createTokens(User $user) {
        $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS')); // TOKEN_EXP_ACCESS from .env
        $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'), false);

        return [$accessToken, $refreshToken];
    }

    /**
     * Refresh Token 업데이트
     * 
     * @param App\Model\User $userInfo 유저정보
     * @param string $refreshToken
     * 
     * @return bool true
     */
    public function updateRefreshToken(User $userInfo, string $refreshToken) {
        // 유저 모델에 리프레시 토큰 변경
        $userInfo->refresh_token = $refreshToken; // refresh_token : 컬럼명

        DB::beginTransaction();

        if(!($userInfo->save())) {
            DB::rollBack();
            throw new PDOException('Error updateRefreshToken()');
        }

        DB::commit();

        return true;
    }

    // --------------------------------
    // private
    // --------------------------------

    /**
     * JWT 생성
     * 
     * @param  App\Models\User $user
     * @param  int $ttl(time to limit)
     * @param  bool $accessFlg = true
     * 
     * @return string JWT
     */

    private function createToken(User $user, int $ttl, bool $accessFlg = true) {
        $header = $this->createHeader();
        $payload = $this->createPayload($user, $ttl, $accessFlg);
        $signature = $this->createSignature($header, $payload);

        return $header.'.'.$payload.'.'.$signature;
    } // 외부에서 접근 못하게 private

    /**
     * JWT Header 생성
     * 
     * @return  string base64UrlEncode
     */

    private function createHeader() {
        $header = [
            'alg' => env('TOKEN_ALG')
            ,'typ' => env('TOKEN_TYPE')
        ]; // 토큰에서 사용하는 이름은 일반적으로 세 글자 약어를 사용
    
        return MyEncrypt::base64UrlEncode(json_encode($header));
    }

    /**
     * JWT Payload 작성
     * 
     * @param  App\Models\User $user
     * @param  int $ttl(time to limit)
     * @param  bool $accessFlg = true
     * 
     * @return string base64Payload
     */
    private function createPayload(User $user, int $ttl, bool $accessFlg = true) {
        $now = time(); // 현재 시간

        // 페이로드 기본 데이터 생성
        $payload = [
            'idt' => $user->user_id // identity
            ,'iat' => $now // issued date 발급 시간
            ,'exp' => $now + $ttl // expired 
            ,'ttl' => $ttl
        ];

        // 엑세스 토큰일 경우 아래 데이터 추가
        if($accessFlg) {
            $payload['acc'] = $user->account;
        }

        return MyEncrypt::base64UrlEncode(json_encode($payload));
    }

    /**
     * JWT Signature 작성
     * 
     * @param  string $header
     * @param  string $payload
     * 
     * @return  string base64Signature
     */
    private function createSignature(string $header, string $payload) {
        return MyEncrypt::hashWithSalt(env('TOKEN_ALG'), $header.env('TOKEN_SECRET_KEY').$payload, MyEncrypt::makeSalt(env('TOKEN_SALT_LENGTH')));
    }
}