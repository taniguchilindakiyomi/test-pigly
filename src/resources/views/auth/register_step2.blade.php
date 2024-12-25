<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>test-Pigly</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register_step2.css')}}">
</head>

<body>
    <main>
        <form class="form" action="/register/step2" method="post">
            @csrf
            <h1>PiGLy</h1>
            <div>新規会員登録</div>
            <p>STEP2 体重データの入力</p>

            <div class="register-form__group">
                <label class="register-form__label" for="weight">現在の体重</label>
                <input class="register-form__input" type="text" name="weight" id="weight" placeholder="現在の体重を入力">kg
                <p class="register-form__error-message">
                    @error('weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="target_weight">目標体重</label>
                <input class="register-form__input" type="text" name="target_weight" id="target_weight" placeholder="目標体重を入力">kg
                <p class="register-form__error-message">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="register-form__btn" type="submit">アカウント作成</button>
        </form>
    </main>
</body>
</html>