<!-- resources/views/todo.blade.php -->
@extends('layouts.app')

@section('content')

<!-- Bootstrap -->
<div class="card-body">
    <div class="card-title">
        <h1>Todoリスト追加</h1>
        リストを追加してください
    </div>

    <!-- バリデーション表示 -->
    @include('common.errors')

    <!-- body 登録 -->
    <form action="{{url('/todos')}}" method="POST" class="form-horizontal">
    @csrf
        
        <!-- text 文 -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">リスト</label>
                <div class="col-sm-6">
                    <input type="text" name="body" class="form-control">
                </div>
        </div>
       
        <!-- 登録ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-ms-6">
                <button type="submit" class="btn btn-primary">
                    追加
                </button>
            </div>
        </div>
    </form>
</div>   

<!-- フラッシュメッセージ -->
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<!-- Todo に登録されているリスト -->
@if (count($todos) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table">           
            <!-- テーブルヘッダ -->
            <thead>
                <th> Todo リスト 一覧 </th>
                <!-- <th> &nbsp; </th> -->
            </thead>

            <!-- テーブルボディ -->
            <tbody>
            @foreach( $todos as $todo)
                <tr>
                    <!-- Todo -->
                    <td class="table-text">
                        <div>{{ $todo -> body }}</div>
                    </td>

                    <!-- 編集 -->
                    <td>
                        <form action="{{ url('todos/'.$todo -> id.'/edit') }}" method="GET">
                            <button type="submit" class="btn btn-primary">
                                    更新
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('todos/'.$todo -> id) }}" method="POST">
                        @csrf
                        @method('delete')
                            <button type="submit" class="btn btn-danger">
                                    削除
                            </button>         
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ページネーション -->
<div class="row mx-4">
    <div class="col-md-4 ofset-md-4">
        {{ $todos -> links() }}
    </div>
</div>
@endif

@endsection
