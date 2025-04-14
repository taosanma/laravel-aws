@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 戻るボタン -->
    <a href="{{ route('events.show') }}" class="btn btn-secondary mb-3">戻る</a>
    <h1>イベント作成</h1>

    <!-- フラッシュメッセージ -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- バリデーションエラー表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="event_name">イベント名</label>
            <input type="text" name="event_name" id="event_name" class="form-control" value="{{ old('event_name') }}" required>
        </div>

        <div class="form-group">
            <label for="event_date">開催日</label>
            <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date') }}" required>
        </div>

        <div class="form-group">
            <label for="event_start_date">開始日時</label>
            <input type="datetime-local" name="event_start_date" id="event_start_date" class="form-control" value="{{ old('event_start_date') }}">
        </div>

        <div class="form-group">
            <label for="event_end_date">終了日時</label>
            <input type="datetime-local" name="event_end_date" id="event_end_date" class="form-control" value="{{ old('event_end_date') }}">
        </div>

        <div class="form-group">
            <label for="event_description">説明</label>
            <textarea name="event_description" id="event_description" class="form-control" rows="4">{{ old('event_description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="event_location">場所</label>
            <input type="text" name="event_location" id="event_location" class="form-control" value="{{ old('event_location') }}">
        </div>

        <div class="form-group">
            <label for="event_price">料金（円）</label>
            <input type="number" name="event_price" id="event_price" class="form-control" step="0.01" value="{{ old('event_price', 0) }}">
        </div>

        <div class="form-group">
            <label for="event_capacity">定員</label>
            <input type="number" name="event_capacity" id="event_capacity" class="form-control" value="{{ old('event_capacity') }}">
        </div>

        <button type="submit" class="btn btn-primary">イベントを作成</button>
    </form>
</div>
@endsection
