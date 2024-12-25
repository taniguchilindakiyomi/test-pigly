<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test-Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/update.css') }}">
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
            
        </form>

    </main>
</body>
</html>