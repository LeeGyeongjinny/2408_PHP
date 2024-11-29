<?php

namespace App\Utils;

use App\Models\User;
use MyEncrypt;

class MyToken {
    /**
     * Access Token & Refresh Token 생성
     * 
     * @param App\Models\User $user
     * @return Array [$accessToken, $refreshToken]
     */

    public function createTokens(User $user) {
        $accessToken = $this->createToken($user, env('TOKEN_EXP_ACCESS'));
        $refreshToken = $this->createToken($user, env('TOKEN_EXP_REFRESH'), false);

        return [$accessToken, $refreshToken];
    }

    /**
     * JWT 생성
     * 
     * @param App\Models\User $user
     * @param int $ttl(time to limit)
     * @param bool $accessFlg = true
     * 
     * @return string JWT
     */

    private function createToken(User $user, int $ttl, bool $accessFlg = true) {
        $header = $this->createHeader();
        $payload = $this->createPayload($user, $ttl, $accessFlg);
        $signature = $this->createSignature($header, $payload);

        return $header.'.'.$payload.'.'.$signature;
    }

    /**
     * JWT Header 생성
     * 
     * @return string base64UrlEncode
     */

    private function createHeader() {
        $header = [
            'alg' => env('TOKEN_ALG')
            ,'typ' => env('TOKEN_TYPE')
        ];
        
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
            'idt' => $user->user_id 
            ,'iat' => $now
            ,'exp' => $now + $ttl 
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