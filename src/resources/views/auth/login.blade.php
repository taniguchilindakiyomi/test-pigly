<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>test-Pigly</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <main>
        <form class="form" action="/login" method="post">
            @csrf
            <div class="logo-content">
            <h1>PiGLy</h1>
            <div class="login-logo">ログイン</div>
            </div>
            <div class="login-form__group">
                <label class="login-form__label" for="email">メールアドレス</label>
                <input type="email" name="email" id="email" placeholder="メールアドレスを入力">
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="login-form__group">
                <label class="login-form__label" for="password">パスワード</label>
                <input class="login-form__input" type="password" name="password" id="password" placeholder="パスワードを入力">
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="login-form__btn" type="submit" value="ログイン">
        </form>
    </main>
</body>
</html>