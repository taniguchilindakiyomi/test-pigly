<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>test-Pigly</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register_step1.css') }}">
</head>
<body>
    <main>
        
        <form class="form" action="{{ route('register.step1') }}" method="post" autocomplete="on">
            @csrf
            <h1>PiGLy</h1>
            <div>新規会員登録</div>
            <p>STEP1 アカウント情報の登録</p>
            
            <div class="register-form__group">
                <label class="register-form__label" for="name">お名前</label>
                <input class="register-form__input" type="text" name='name' id="name" placeholder="名前を入力" autocomplete="name">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input class="register-form__input" type="email" name="email" id="email" placeholder="メールアドレスを入力" autocomplete="email">
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワードを入力" autocomplete="new-password">
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="register-form__next-btn" type="submit">次に進む</button>
            <a href="/login">ログインはこちら</a>
        </form>
    </main>
</body>
</html>