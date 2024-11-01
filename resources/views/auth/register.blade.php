@extends('layout')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col col-md-offset-3 col-md-6">
                    <nav class="panel panel-default">
                        <div class="panel-heading">会員登録</div>
                        <div class="panel-body">
                            @if($errors -> any()) {{-- $errors -> any(): $errorsの中にerrorがあったらtrue/無かったらfalse --}}
                            <div class="alert alert-danger">
                               
                                <ul>
                                    @foreach($errors->all() as $message) {{-- $errors->all(): エラー情報が配列になっているためforeachで返す --}}
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                                
                            </div>
                            @endif  
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">メールアドレス</label>
                                    <input type="text" class="form-control" id="email" name="email"value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">ユーザー名</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">パスワード</label>
                                    <input type="text" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">パスワード(確認)</label>
                                    <input type="text" class="form-control" id="password-confirm" name="password_confirmation">
                                    <!-- passwordの確認用フィールドのname属性値はlaravelのルール。完全一致するかどうかバリデーションで確認する為、ルールに沿う必要がある -->
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">送信</button>
                                </div><!-- close_text-right -->
                            </form>
                        </div><!-- close_panel-body -->
                    </nav>
                </div><!-- close_col col-md-offset-3 col-md-6 -->
            </div><!-- close_row -->
        </div><!-- close_container -->
@endsection