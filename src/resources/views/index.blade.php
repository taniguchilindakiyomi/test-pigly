<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>test-Pigly</title>
    
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


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
      <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">目標体重</div>
                <div class="card-body">
                    <h2>{{ $weightTarget->target_weight ?? '---' }}kg</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">目標までの差</div>
                <div class="card-body">
                    @if($weightTarget && $currentWeight)
                        <h2>{{ number_format($weightDifference, 1) }}kg</h2>
                    @else
                        <h2>---</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">現在体重</div>
                <div class="card-body">
                    <h2>{{ $currentWeight->weight ?? '---' }}kg</h2>
                </div>
            </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          <form  class="form-inline" action="/weight_logs/search" method="get">
            <input class="form-control mx-2" type="date" id="start_date" name="start_date">~
            <input class="form-control" type="date" id="end_date" name="end_date">

            <button type="submit" class="btn btn-primary mx-2">検索</button>
            @if(request()->has('start_date') || request()->has('end_date'))
                <a href="/weight_logs" class="btn btn-secondary mx-2">リセット</a>
            @endif
        </form>

        @if(request('start_date') && request('end_date'))
            <h5 class="mt-3">{{ $startDate }} ～ {{ $endDate }} の検索結果: {{ $count }}件</h5>
        @endif

<div class="mt-2">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addWeightLogModal">データ追加</button>
</div>


<div class="modal fade" id="addWeightLogModal" tabindex="-1" role="dialog" aria-labelledby="addWeightLogModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWeightLogModalLabel">Weight Logを追加</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/weight_logs/create" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">日付<span class="required-label">必須</span></label>
                        <input class="form-control" type="date" id="date" name="date" value="{{ old('date', \Carbon\Carbon::today()->format('Y-m-d')) }}">
                        <div class="form__error">
                            @error('date')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="weight">体重<span class="required-label">必須</span></label>
                        <input class="form-control" type="number" step="0.1" id="weight" name="weight" placeholder="50.0">kg
                        <div class="form__error">
                            @error('weight')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="calories">食事摂取カロリー<span class="required-label">必須</span></label>
                        <input class="form-control" type="number" id="calories" name="calories" placeholder="1200">cal
                        <div class="form__error">
                            @error('calories')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exercise_time">運動時間<span class="required-label">必須</span></label>
                        <input class="form-control" type="time" id="exercise_time" name="exercise_time" placeholder="00:00">
                        <div class="form__error">
                            @error('exercise_time')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exercise_content">運動内容</label>
                        <textarea class="form-control" id="exercise_content" name="exercise_content" rows="3" placeholder="運動内容を追加"></textarea>
                        <div class="form__error">
                            @error('exercise_content')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>体重</th>
                        <th>食事摂取カロリー</th>
                        <th>運動時間</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weightLogs as $log)
                    <tr class="log-row">
                        <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                        <td>{{ number_format($log->weight, 1) }}kg</td>
                        <td>{{ number_format($log->calories, 0) }}cal</td>
                        <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="/weight_logs/{weightLogId}" alt="えんぴつ">編集</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $weightLogs->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
      </div>
    </main>
</body>
</html>