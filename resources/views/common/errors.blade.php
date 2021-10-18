@if(count($errors) > 0)
    <!-- form Error list -->
    <div class="alert alert-danger">
        <div><strong> 入力内容を確認してください </strong>
            <ul>
                @foreach ($errors -> all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif