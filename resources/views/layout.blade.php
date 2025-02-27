<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">  
</head>
<body>
  <header>
    <nav class="my-navbar">
      <a href="/" class="my-navbar-brand">ToDo App</a>
      <div class="my-navbar-control">
      @if(Auth::check())
        <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="post" style="display:none;">
          @csrf
        </form>
      @else
      <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
      ｜
      <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
      @endif
      </div><!-- close my-navbar-control -->
    </nav>
  </header>
  <main>
    @yield('content') 
    </main>
@if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
@endif
@yield('scripts')
</body>
</html>