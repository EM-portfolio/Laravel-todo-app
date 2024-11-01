@extends('layout')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col col-md-offset-3 col-md-6">
                    <nav class="panel panel-default">
                        <div class="panel-heading">フォルダを追加する</div>
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
                            <form action="{{ route('folders.create') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="title">フォルダ名</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"/>
                                </div><!-- close_form-group -->
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