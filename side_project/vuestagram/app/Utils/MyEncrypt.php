<?php

namespace App\Utils;

use Illuminate\Support\Str;

class MyEncrypt {
    /**
     * base64 URL encode
     * 
     * @param  string $json
     * @return  string base64 URL encode
     */
    public function base64UrlEncode(string $json) {
        return rtrim(strtr(base64_encode($json), '+/', '-_'),'=');
    }

    /**
     * 솔트(특정 길이만큼 랜덤한 문자열) 생성
     * 
     * @param  int $saltLength
     * 
     * @return  string 랜덤 문자열
     */
    public function makeSalt($saltLength) {
        return Str::random($saltLength);
    }

    /**
     * 문자열 암호화
     * 
     * @param  string $alg 알고리즘명
     * @param  string $str 암호화할 문자열
     * @param  string $salt 솔트
     * 
     * @return string 암호화된 문자열
     */
    public function hashWithSalt(string $alg, string $str, string $salt) {
        return hash($alg, $str).$salt; // 혹시라도 모를 복호화 방지
    }
}