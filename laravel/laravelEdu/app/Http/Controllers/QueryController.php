<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QueryController extends Controller
{
    public function index(Request $request) {
        // -----------------
        // 쿼리 빌더
        // -----------------
        // 쿼리 빌더를 이용하지 않고 SQL 작성
        // select
        $result = DB::select('SELECT * FROM users');
        $result = DB::select('SELECT * FROM users WHERE u_email = :u_email', ['u_email' => 'admin@admin.com']);
        $result = DB::select('SELECT * FROM users WHERE u_email = ?' , ['admin@admin.com']);

        // insert
        // DB::insert('INSERT INTO boards_category (bc_type, bc_name) VALUES(?, ?)', [3, '테스트게시판']);

        // update
        // DB::update('UPDATE boards_category SET bc_name = ? WHERE bc_type = ?', ['미어캣게시판', '3']);

        // delete
        // DB::delete('DELETE FROM boards_category WHERE bc_type = ?', ['3']);

        // -----------------
        // 쿼리 빌더 체이닝
        // -----------------
        // users 테이블 모든 데이터 조회
        // select * from users;
        $result = DB::table('users')->get();
        
        // select * from users where name = ? ['관리자'];
        $result = DB::table('users')
                        ->where('u_name', '=', '관리자')
                        ->get();

        // select * from boards where bc_type = ? and b_id < ?, ['0', 5];
        $result = DB::table('boards')
                        ->where('bc_type', '=', '0')
                        ->where('b_id', '<', 5)
                        ->get();

        // select * from boards where bc_type = ? or b_id < ?, ['0', 10];
        $result = DB::table('boards')
                        ->where('bc_type', '=', '0')
                        ->orWhere('b_id', '<', 10)
                        ->get();

        // select b_title, b_content from boards where b_id in (?, ?) [1, 2];
        $result = DB::table('boards')
                        ->select('b_title', 'b_content')
                        ->whereIn('b_id', [1, 2])
                        ->get();

        // select * from boards where deleted_at is null;
        $result = DB::table('boards')
                        ->whereNull('deleted_at')
                        ->get();
        
        // select * from users where YEAR(created_at) = ? ['2024'];
        $result = DB::table('users')
                        ->whereYear('created_at', '=' , '2024')
                        ->get();
                        // ->dd(); // 개발하다가 테스트용

        // $result = DB::table('users')
        //                 ->where('created_at', '>=' , '2024-01-01 00:00:00')
        //                 ->where('created_at', '<=' , '2024-12-31 23:59:59')
        //                 ->get();

        // 게시판별 게시글 개수
        // SELECT bc_type, count(*) FROM boards GROUP BY bc_type
        $result = DB::table('boards')
                        ->select('bc_type', DB::raw('COUNT(*) cnt'))
                        ->groupBy('bc_type')
                        ->get();

        // SELECT bc_type, count(*) FROM boards GROUP BY bc_type HAVING bc_type = '0'
        $result = DB::table('boards')
                        ->select('bc_type', DB::raw('COUNT(*) cnt'))
                        ->groupBy('bc_type')
                        ->having('bc_type', '=', '0')
                        ->get();

        // select b_id, b_title from boards order by b_id limit ? offset ? [1, 2];
        $result = DB::table('boards')
                        ->select('b_id', 'b_title')
                        ->orderBy('b_id', 'asc')
                        ->limit(1)
                        ->offset(2)
                        ->get();

        $requestData = [
            'u_id' => 1
        ];
        // null, false, 0, '' []의 경우에 when 조건 실행되지 않는다
        $result = DB::table('users')
                        ->when($requestData['u_id'], function($query, $u_id) {
                            $query->where('u_id', '=', $u_id);
                        })
                        ->get();

        // 삭제되지 않은 글 중에 제목에 자유와 또는 질문이 포함되어 있는 게시글 검색
        // SELECT * FROM boards WHERE deleted_at IS NULL AND (b_title LIKE '%자유%'	OR b_title LIKE '%질문%');
        $result = DB::table('boards')
                        ->whereNull('deleted_at')
                        ->where(function($query) {
                            $query->where('b_title', 'like', '%자유%')
                                    ->orWhere('b_title', 'like', '%질문%');
                        })
                        ->get();

        // first() : 쿼리 결과 중에 첫번째 레코드만 반환
        $result = DB::table('users')->first();
        // find($id) : 지정된 PK에 해당하는 레코드를 반환
        // $result = DB::table('users')->find(1);
        // count() : 쿼리 결과의 레코드 수를 반환
        $result = DB::table('users')->count();

        // Insert
        // $result = DB::table('users')
        //         ->insert([
        //             'u_email' => 'kim@admin.com'
        //             ,'u_password' => Hash::make('qwer1234')
        //             ,'u_name' => '김영희'
        //         ]); // 이렇게 하면 insert 완료

        // 이렇게 해도 됨
        $arr = [
            'u_email' => 'kim@admin.com'
            ,'u_password' => Hash::make('qwer1234')
            ,'u_name' => '김영희'
        ];
        // $result = DB::table('users')
        //                 ->insert($arr); // 이렇게 하면 insert 완료

        // Update
        // $result = DB::table('users')
        //                 ->where('u_id', '=', 4)
        //                 ->update([
        //                     'u_name' => '김철수'
        //                 ]);

        // Delete
        // $result = DB::table('users')
        //                 ->where('u_id', '=', 4)
        //                 ->delete();

        
        // --------------------------------------
        // Eloquent Model
        // --------------------------------------
        // $result = DB::table('users')->get(); // 아깐 이렇게함
        $result = User::where('u_name', '=', '홍길동')->first();
        // $result = User::find(1); // User -> 모델명의 복수형을 테이블모델로 인식한다(users)
        // $result->u_name = '테스트';


        // Insert
        // $userInsert = new User();
        // $userInsert->u_email = $request->u_email;
        // $userInsert->u_password = Hash::make($request->u_password);
        // $userInsert->u_name = $request->u_name;
        // $userInsert->save();
        
        // Update
        // $userUpdate = User::find(9);
        // $userUpdate->u_name = '김철수';
        // $userUpdate->save();

        // delete
        $userDelete = User::destroy(9);

        // 삭제된 데이터도 포함해서 검색하고 싶을 때
        $result = User::withTrashed()->count();
            
        // 삭제된 데이터만 검색하고 싶을 때 
        $result = User::onlyTrashed()->count();

        // 삭제된 데이터를 되살리고 싶을 때
        $result = User::where('u_id', 9)->restore();
        
        // var_dump($userInsert);
        var_dump($result);
        return '';
    }
}