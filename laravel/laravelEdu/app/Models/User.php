<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // trait(트레이트)
    // SoftDeletes 트레이트 : 해당 모델에 소프트딜리트를 적용하고 싶을 때 추가
    use HasApiTokens, HasFactory, Notifiable,  SoftDeletes;

    // 테이블명 정의하는 프로퍼티 (디폴트는 모델명의 복수형)
    protected $table = 'users';

    // PK를 지정하는 프로퍼티
    protected $primaryKey = 'u_id'; 

    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at'; 

    /**
     * upsert시 변경을 허용할 컬럼들을 설정하는 프로퍼티 (화이트리스트)
     */
    protected $fillable = [
        'u_email'
        ,'u_password'
        ,'u_name'
        ,'created_at'
        ,'updated_at'
        ,'deleted_at'
    ];
    
    /**
     * upsert시 변경을 불허할 컬럼들을 설정하는 프로퍼티 (블랙리스트)
     */
    // protected $guarded = [
    //     'id'
    // ];
}