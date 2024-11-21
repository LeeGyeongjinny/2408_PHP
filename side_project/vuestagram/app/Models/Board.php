<?php

namespace App\Models;

// use DateTimeInterface; // @param DateTimeInterface $date 이거 할 때 사용
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'board_id';

    protected $fillable = [
        'user_id',
        'content',
        'img',
        'like',
    ];

    /**
     * TimeZone format when serializing JSON
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s)
     */
    protected function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }
    // \DateTimeInterface : 이거 use안해서 풀로 적어준 것
    // use해서 @param DateTimeInterface $date 하면 똑같이 작동함
}
