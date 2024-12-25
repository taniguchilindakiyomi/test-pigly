<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test-Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <main>
        <div class="container">
    <h1>体重ログ編集</h1>
    <form action="{{ route('weight_logs.update', ['id' => $log->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="weight">体重 (kg)</label>
            <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', $log->weight) }}" required>
        </div>

        <div class="form-group">
            <label for="calories">カロリー (kcal)</label>
            <input type="number" name="calories" id="calories" class="form-control" value="{{ old('calories', $log->calories) }}">
        </div>

        <div class="form-group">
            <label for="exercise_time">運動時間 (分)</label>
            <input type="number" name="exercise_time" id="exercise_time" class="form-control" value="{{ old('exercise_time', $log->exercise_time) }}">
        </div>

        <div class="form-group">
            <label for="exercise_content">運動内容</label>
            <textarea name="exercise_content" id="exercise_content" class="form-control">{{ old('exercise_content', $log->exercise_content) }}</textarea>
        </div>

        <a href="/weight_logs" class="goal-setting-back">戻る</a>
        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
    <form class="delete-form" action="" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">削除</button>
    </form>
</div>
    </main>
</body>
</html>