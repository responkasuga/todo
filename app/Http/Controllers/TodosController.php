<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Todo;
use Validator;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PHPUnit\TextUI\XmlConfiguration\Variable;

class TodosController extends Controller
{
    // コンストラクタ クラスが呼ばれたら最初に処理
    public function __construct()
    {
        $this -> middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $todos = Todo::where('user_id', Auth::user()->id)
        ->orderBy('created_at','desc')
        ->paginate(5);
        
        return view('todo', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // 登録
        // バリデーション
        $validator = Validator::make($request -> all(), ['body' => 'required|max:255',
        ]);

        //バリデーション：エラー
        if ($validator -> fails()){
            return redirect('todos')
                -> withInput()
                -> withErrors($validator);
        }

        // 登録処理
        $todos = new Todo;
        $todos -> user_id = Auth::user()->id;
        $todos -> body = $request -> body;
        $todos -> save();
        return redirect('todos') -> with('message','投稿が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        // 追加・更新後の画面
        $todos = todo::where('user_id', Auth::user()->id)->find($user_id);
        return view('show', ['todo' => $todos]);
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
        //バリデーション
        $validator = Validator::make($request -> all(),[
            'id' => 'required',
            'body' => 'required|max:255',
        ]);

        // バリデーションエラー
        if($validator -> fails()){
            return redirect('todos')
                -> withInput()
                -> withErrors($validator);
        }

        // 更新
        $todos = todo::where('user_id', Auth::user()->id)->find($id);
        $todos -> id = $request -> id;
        $todos -> body = $request -> body;
        $todos -> save();
        return redirect('todos') ->with('message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 削除        
        $todos = Todo::find($id);
        $todos -> delete();
        return redirect('/todos');

    }
}
