<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller {
    public function show()
    {
        // Schejule モデルから全てのデータを取得
        $schejules = \App\Models\Schejule::all();
        Log::info('スケジュールデータ', ['schejules' => $schejules]);

        // イベントデータをカレンダー用に整形
        $events = $schejules->map(function ($schejule) {
            return [
                'id' => $schejule->schejules_id, // イベントID
                'title' => $schejule->event_name,
                'date' => $schejule->event_date,
                'start' => \Carbon\Carbon::parse($schejule->event_start_date)->format('Y-m-d\TH:i'),
                'end' => \Carbon\Carbon::parse($schejule->event_end_date)->format('Y-m-d\TH:i'),     // 終了日時をISO8601形式に変換
                'description' => $schejule->event_description,
                'location' => $schejule->event_location,
            ];
        });

        Log::info('スケジュールデータ', ['events' => $events]);

        // 取得したデータをビューに渡す
        return view('index', compact('events'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_start_date',
            'event_description' => 'nullable|string',
            'event_location' => 'nullable|string',
            'event_price' => 'nullable|numeric|min:0',
            'event_capacity' => 'nullable|integer|min:0',
        ]);

        \App\Models\Schejule::create($validated);

        return redirect()->route('events.create')->with('success', 'イベントを作成しました！');
    }

    public function edit($id){
        $event = \App\Models\Schejule::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id){
        $event = \App\Models\Schejule::findOrFail($id);
        Log::info('スケジュールデータ', ['event' => $event]);
        Log::info('スケジュールデータ1', ['request' => $request]);
        // 値を更新
        $event->event_name = $request->input('event_name');
        $event->event_date = $request->input('event_date');
        $event->event_start_date = $request->input('event_start_date');
        $event->event_end_date = $request->input('event_end_date');
        $event->event_description = $request->input('event_description');
        $event->event_location = $request->input('event_location');

        // 保存（DBに反映）
        $event->save();

        return redirect()->route('events.show')->with('success', 'イベントを更新しました！');
    }

    public function destroy($id){
        $event = \App\Models\Schejule::findOrFail($id);
        $event->delete();

        return redirect()->route('events.show')->with('success', 'イベントを削除しました。');
    }
}