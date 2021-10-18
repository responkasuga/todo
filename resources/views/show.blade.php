<!-- resources/views/show.blade.php -->
@extends('layouts.app')

@section('content')

<!-- Bootstrap -->
<div class="card-body">
    <div class="card-title">
        <h1>　Todoリスト編集　</h1>
        Todoを編集できます
    </div>

    <!-- バリデーション表示 -->
    @include('common.errors')

    <!-- body 登録 -->
    <tbody>
        <form action="{{ url('todos/'.$todo -> id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')
            <tr>
                <!-- text 文 -->
                <td>
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">リスト</label>
                            <div class="col-sm-6">
                                <!-- id -->
                                <input type="hidden" name="id" value="{{ $todo -> id }}">
                                <!-- body -->
                                <input type="text" name="body" class="form-control" value="{{ $todo -> body }}">
                            </div>
                    </div>
                </td>
            </tr>
            <!-- 登録ボタン -->
            <tr>             
                <div class="form-group">
                    <div class="col-sm-offset-3 col-ms-6">
                        <td>   
                            <button type="submit" class="btn btn-primary">
                                更新
                            </button>
                        </td>
                        <td>
                            <a class="btn btn-link pull-right" href="{{ url('todos') }}">
                                戻る
                            </a>
                        </td>
                    </div>
                </div>
            </tr>
        </form>
    </tbody>
</div>
@endsection