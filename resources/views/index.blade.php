<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>イベント一覧</title>

    <!-- FullCalendar のスタイルシートを読み込む -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />

    <!-- 自分で作成したCSSファイルをリンク -->
    @vite(['resources/css/style.css','resources/css/components/button.css']) {{-- ←これ追加 --}}

    <!-- フォントやアイコンをインポート -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <!-- 背景画像とコンテンツ全体をラップ -->
    <div class="page-wrapper">
        <!-- イベント作成ポリシーや情報セクション -->
        <div class="policy-section">
            <div class="policy-content">
                <div class="policy-text">
                    <h2>イベント参加ポリシー</h2>
                    <p>私たちは、参加者が楽しく充実した時間を過ごせるよう、以下のポリシーを設けています:</p>
                    <ul>
                        <li>参加者全員が平等に楽しめるよう配慮しています。</li>
                        <li>イベントは無料、もしくは参加費がかかりますが、事前にお知らせします。</li>
                        <li>参加者の健康と安全を最優先に考えています。</li>
                    </ul>
                    <a href="{{ route('events.create') }}" class="btn-create-event">イベントを作成</a>
                </div>
                <div class="policy-image">
                    <img src="{{ asset('image/school.jpg') }}" alt="Event Policy Image">
                </div>
            </div>
        </div>
        <!-- フラッシュメッセージ -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- カレンダー表示のコンテナ -->
        <div class="container">
            <h1>イベント一覧</h1>

            <!-- FullCalendar のカレンダーを表示するための div -->
            <div id="calendar"></div>
        </div>

        <!-- イベント編集モーダル -->
        <div id="editEventModal" class="modal" tabindex="-1" role="dialog" style="display: none;">
            @include('edit') <!-- モーダル内容を別ファイルに分けて読み込む -->
        </div>


<!-- モーダル本体 -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include('edit') <!-- モーダル内容を別ファイルに分けて読み込む -->
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- FullCalendar と jQuery のスクリプトを読み込む -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() {

        var isModalVisible = false;
        console.log(@json($events));

        $('#calendar').fullCalendar({
            events: @json($events), // コントローラから渡されたイベントデータを表示

            eventRender: function(event, element) {
                // ツールチップを表示
                element.attr('title', event.description);
            },

            // ←↓↓↓ここに追加する↓↓↓
            eventClick: function(event, jsEvent, view) {
                console.log(event);
                console.log(event.start.format('YYYY-MM-DD HH:mm'));
                $('#eventId').val(event.id); // クリックしたイベントのIDをフォームにセット
                $('#eventTitle').val(event.title); // タイトル
                $('#eventDate').val(event.date); // 開始日時
                $('#eventStart').val(event.start.format('YYYY-MM-DD HH:mm'));
                $('#eventEnd').val(event.end.format('YYYY-MM-DD HH:mm'));
                $('#eventDescription').val(event.description || ''); // 説明
                $('#eventLocation').val(event.location || ''); // 場所
                $('#editEventModal').show(); // モーダルを表示

                console.log('eventStart:', $('#eventStart').val());
                console.log('eventEnd:', $('#eventEnd').val());
                const editForm = document.getElementById('editEventForm');
                const deleteForm = document.getElementById('deleteEventId');
                editForm.action = `/events/${event.id}`;
                deleteForm.action = `/events/${event.id}`;
                console.log(editForm.action);
            },

            locale: 'ja',  // 日本語表示

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            editable: true,
            droppable: true, // ドラッグ＆ドロップ機能
            eventLimit: true // イベントが多くなった時に省略表示
        });
    });
    </script>

</body>
</html>
