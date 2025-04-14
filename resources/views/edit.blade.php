@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 戻るボタン -->
    <a href="{{ route('events.show') }}" class="btn btn-secondary mb-3">戻る</a>
    <h1>イベント編集</h1>

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

    <!-- モーダル用フォーム -->
    <form action="{{ route('events.update', '1') }}" method="POST" id="editEventForm">
        @csrf
        @method('PUT')

        <input type="hidden" name="event_id" id="eventId"> <!-- イベントID -->

        <div class="form-group">
            <label for="event_name">イベント名</label>
            <input type="text" name="event_name" id="eventTitle" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="event_date">開催日</label>
            <input type="date" name="event_date" id="eventDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="event_start_date">開始日時</label>
            <input type="datetime-local" name="event_start_date" id="eventStart" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="event_end_date">終了日時</label>
            <input type="datetime-local" name="event_end_date" id="eventEnd" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="event_description">説明</label>
            <textarea name="event_description" id="eventDescription" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="event_location">場所</label>
            <input type="text" name="event_location" id="eventLocation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">イベントを更新</button>
    </form>
    <form action="{{ route('events.destroy', '1') }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="mt-3">
        @csrf
        @method('DELETE')
        <input type="hidden" name="event_id" id="deleteEventId">
    <button type="submit" class="btn btn-danger">イベントを削除</button>
</form>
</div>
@endsection
