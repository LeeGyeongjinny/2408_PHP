<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 리스트 데이터 획득
        $result = Board::select('b_id', 'b_title', 'b_content', 'b_img')
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('b_id', 'DESC')
                    ->get();

        return view('boardList')->with('data', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('b_img')->store('img'); // public > img폴더
        
        // $path = $request->file('b_img')->storeAs('img', uniqid(), 'local');
        // 1. root이후로 어디에 저장할지


        try {
            DB::beginTransaction();
            
            // Board::create([
            //     'bc_type' => $request->bc_type
            //     ,'u_id' => Auth::id()
            //     ,'b_title' => $request->b_title
            //     ,'b_content' => $request->b_content
            //     ,'b_img' => $path
            // ]);
        
            $boardInsert = new Board();
            $boardInsert->bc_type = $request->bc_type;
            $boardInsert->u_id = Auth::id();
            $boardInsert->b_title = $request->b_title;
            $boardInsert->b_content = $request->b_content;
            $boardInsert->b_img = $path;
            $boardInsert->save();
            
            
            // $resultBoardInsert = $boardInsert->Board($request);
            // if($resultBoardInsert !== 1) {
            //     throw new Exception('게시글 작성 실패');
            // }

            DB::commit();

        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->route('boards.create')->withErrors($th->getMessage());
        }

        return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::debug('***** boards.show Start *****');
        Log::debug('requested id : '.$id);

        $result = Board::find($id);
        // $result = Board::join('users', 'boards.u_id', '=', 'users.u_id')
        //             ->select('boards.b_title', 'boards.b_content', 'boards.b_img', 'users.u_name')
        //             ->get();
        
        Log::debug('획득한 상세 데이터', $result->toArray());

        return response()->json($result->toArray());
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
        //
    }
}
