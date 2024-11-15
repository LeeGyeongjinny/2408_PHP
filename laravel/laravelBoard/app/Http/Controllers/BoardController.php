<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 게시글 타입 획득
        $bcType = '0';
        if($request->has('bc_type')) {
            $bcType = $request->bc_type;
        }

        // 리스트 데이터 획득
        $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                    ->where('bc_type', $bcType) // = 연산자 생략 가능
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('b_id', 'DESC')
                    ->get();

        // 게시판 이름 획득
        $boardInfo = BoardsCategory::where('bc_type', $bcType)->first();

        return view('boardList')
                ->with('data', $result)
                ->with('boardInfo', $boardInfo); // 지금은 따로따로 보내지만 이거보다 배열로 보내는 것이 더 낫다
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('insert');
        return view('boardInsert')->with('bcType', $request->bc_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 실습 --------------------------------------------------
        // $path = $request->file('file')->store('img'); // public > img폴더
        
        // // $path = $request->file('b_img')->storeAs('img', uniqid(), 'local');
        // // 1. root이후로 어디에 저장할지


        // try {
        //     DB::beginTransaction();
            
        //     // Board::create([
        //     //     'bc_type' => $request->bc_type
        //     //     ,'u_id' => Auth::id()
        //     //     ,'b_title' => $request->b_title
        //     //     ,'b_content' => $request->b_content
        //     //     ,'b_img' => $path
        //     // ]);
        
        //     $boardInsert = new Board();
        //     $boardInsert->bc_type = $request->bc_type;
        //     $boardInsert->u_id = Auth::id();
        //     $boardInsert->b_title = $request->b_title;
        //     $boardInsert->b_content = $request->b_content;
        //     $boardInsert->b_img = $path;
        //     $boardInsert->save();
            
            
        //     // $resultBoardInsert = $boardInsert->Board($request);
        //     // if($resultBoardInsert !== 1) {
        //     //     throw new Exception('게시글 작성 실패');
        //     // }

        //     DB::commit();

        // } catch (Throwable $th) {
        //     DB::rollBack();
        //     return redirect()->route('boards.create')->withErrors($th->getMessage());
        // }

        // return redirect()->route('boards.index');

        // -----------------------------------------------------------

        // 수업 ------------------------------------------------------
        // 유효성 검사
        // $validator = Validator::make(
        //     $request->only('b_title', 'b_content', 'file')
        //     ,[
        //         'b_title' => ['required', 'between:1,50']
        //         ,'b_content' => ['required', 'between:1,200']
        //         ,'file' => ['required', 'image']
        //     ]
        // );
        
        // if($validator->fails()) {
        //     return redirect()->route('boards.create')->withErrors($validator);
        // }

        // 이렇게 redirect 안하고 자동으로 이전화면으로 돌아가게 할 수도 있다
        $request->validate([
            'b_title' => ['required', 'between:1,50']
            ,'b_content' => ['required', 'between:1,200']
            ,'file' => ['required', 'image']
            ,'bc_type' => ['required', 'exists:boards_category,bc_type']
        ]);
        // 이것만 해도 문제가 생기면 요청왔던 이전페이지로 자동으로 넘어감

        $filePath = '';
        try {
            // 파일 저장
            $filePath = $request->file('file')->store('img');
            // 만약 insert실패시 이 저장된 파일을 지워줘야한다

            // throw new Exception('test');

            DB::beginTransaction();
    
            // 글 작성 처리
            $insertData = $request->only('b_title', 'b_content', 'bc_type');
            $insertData['b_img'] = '/'.$filePath;
            $insertData['u_id'] = Auth::id();
            Board::create($insertData);

            DB::commit();
        } catch(Throwable $th) {
            DB::rollBack();
            if(Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        return redirect()->route('boards.index', ['bc_type' => $request->bc_type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Log::debug('***** boards.show Start *****');
        // Log::debug('requested id : '.$id);

        $result = Board::find($id);
        
        $responseData = $result->toArray();

        // $responseData['delete_Flg'] = false;
        
        // if($result->u_id === Auth::id()) {
        //     $responseData['delete_Flg'] = true;
        // }

        $responseData['delete_flg'] = $result->u_id === Auth::id(); 
        
        // Log::debug('획득한 상세 데이터', $result->toArray());

        return response()->json($responseData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Board::destroy($id);
        // model > board.php에서 softDeletes trait추가했기 때문에 여기서 deleted_at에 찍어준다
        // 이게 성공하면 1이 와야한다

        $responseData = [
            'success' => $result === 1 ? true : false
        ];

        return response()->json($responseData);
    }
}
