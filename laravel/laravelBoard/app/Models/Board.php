<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'b_id';

    protected $fillable = [
        'u_id'
        ,'bc_type'
        ,'b_title'
        ,'b_content'
        ,'b_img'
    ];

    // 기본 날짜 형식 재정의
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
