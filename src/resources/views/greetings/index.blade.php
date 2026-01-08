<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挨拶一覧</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .back-link {
            display: inline-block;
            color: white;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 1rem;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .back-link:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .greeting-list {
            display: grid;
            gap: 20px;
        }

        .greeting-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .greeting-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .greeting-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f0f0;
        }

        .person-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .person-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #667eea;
        }

        .person-age {
            font-size: 0.9rem;
            color: #666;
            background: #f0f0f0;
            padding: 4px 10px;
            border-radius: 12px;
        }

        .greeting-date {
            font-size: 0.85rem;
            color: #999;
        }

        .greeting-message {
            font-size: 1.1rem;
            color: #333;
            line-height: 1.6;
            padding: 12px;
            background: #f9f9f9;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .empty-state-text {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        .count-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 1rem;
            margin-left: 10px;
        }

        .add-button {
            display: inline-block;
            background: white;
            color: #667eea;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .add-button:hover {
            background: #f8f8f8;
        }

        .delete-button {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .delete-button:hover {
            opacity: 0.9;
        }

        .greeting-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .success-message {
            background: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .greeting-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .greeting-message-wrapper {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← トップページに戻る</a>

        <h1>
            挨拶一覧
            <span class="count-badge">{{ $greetings->count() }}件</span>
        </h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="header-row">
            <a href="{{ route('greetings.create') }}" class="add-button">+ 挨拶を追加</a>
        </div>

        @if($greetings->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div class="empty-state-text">まだ挨拶がありません</div>
                <p style="color: #999;">Tinkerやシーダーでデータを追加してください</p>
            </div>
        @else
            <div class="greeting-list">
                @foreach($greetings as $greeting)
                    <div class="greeting-card">
                        <div class="greeting-header">
                            <div class="person-info">
                                <span class="person-name">{{ $greeting->person->name }}</span>
                                <span class="person-age">{{ $greeting->person->age }}歳</span>
                            </div>
                            <div class="greeting-actions">
                                <div class="greeting-date">
                                    {{ $greeting->created_at->format('Y年m月d日 H:i') }}
                                </div>
                                <form action="{{ route('greetings.destroy', $greeting) }}" method="POST" onsubmit="return confirm('この挨拶を削除してもよろしいですか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                        <div class="greeting-content">
                            <div class="greeting-message-wrapper">
                                <div class="greeting-message">
                                    {{ $greeting->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
