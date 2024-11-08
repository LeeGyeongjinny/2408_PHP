<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function index() {
        // -----------------
        // 쿼리 빌더
        // -----------------
        // 쿼리 빌더를 이용하지 않고 SQL 작성
        // select
        $result = DB::select('SELECT * FROM users');
        $result = DB::select('SELECT * FROM users WHERE u_email = :u_email', ['u_email' => 'admin@admin.com']);
        $result = DB::select('SELECT * FROM users WHERE u_email =?' , ['admin@admin.com']);

        // insert
        // DB::insert('INSERT INTO boards_category (bc_type, bc_name) VALUES(?, ?)', [3, '테스트게시판']);

        // update
        // DB::update('UPDATE boards_category SET bc_name = ? WHERE bc_type = ?', ['미어캣게시판', '3']);

        // delete
        DB::delete('DELETE FROM boards_category WHERE bc_type = ?', ['3']);

        // -----------------
        // 쿼리 빌더 체이닝
        // -----------------
        // users 테이블 모든 데이터 조회
        // select * from users;
        $result = DB::table('users')->get();
        
        var_dump($result);
        return '';
    }
}