<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test-Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/goal_setting/css') }}">
</head>

<body>

        <header class="header">
            <h1 class="header__heading">PiGLy</h1>
            <ul class="header-nav">
              <li class="header-nav__item">
                <a class="header-nav__link" href="/weight_logs/goal_setting"><span class="header-nav__link-logo"></span>目標体重設定</a>
              </li>
              <li class="header-nav__item">
                <form action="/logout" method="post">
                  @csrf
                  <button class="header-nav__button"><span class="header-nav__button-logo"></span>ログアウト</button>
                </form>
              </li>
            </ul>
        </header>

    <main>
        <h1>目標体重設定</h1>
        <form class="update-form" action="{{ route('weight_target.update', ['weightLogId' => $weightLogId]) }}" method="post">
            @csrf
            @method('PATCH')
            <input class="goal-setting-input" name="target_weight" type="text" id="target_weight" placeholder="46.5">kg
            <p class="error-message">
              @error('target_weight')
              {{ $message }}
              @enderror
            </p>

            <a href="/weight_logs" class="goal-setting-back">戻る</a>
            <button class="goal-setting-submit" type="submit">更新</button>
        </form>
    </main>
</body>
</html>