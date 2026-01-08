<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>人一覧</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .people-list {
            display: grid;
            gap: 20px;
        }

        .person-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .person-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .person-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .person-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .person-age {
            font-size: 1rem;
            color: #666;
            background: #f0f0f0;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .greeting-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            transition: opacity 0.3s ease;
        }

        .greeting-button:hover {
            opacity: 0.9;
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

        .success-message {
            background: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
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

        .greeting-count {
            font-size: 0.9rem;
            color: #999;
            margin-top: 8px;
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
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-link">← トップページに戻る</a>

        <h1>
            人一覧
            <span class="count-badge">{{ $people->count() }}人</span>
        </h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('people.create') }}" class="add-button">+ 人を登録</a>

        @if($people->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">👥</div>
                <div class="empty-state-text">まだ人が登録されていません</div>
                <p style="color: #999;">上のボタンから人を登録してください</p>
            </div>
        @else
            <div class="people-list">
                @foreach($people as $person)
                    <div class="person-card">
                        <div class="person-info">
                            <span class="person-name">{{ $person->name }}</span>
                            <span class="person-age">{{ $person->age }}歳</span>
                        </div>
                        <div class="greeting-count">
                            挨拶数: {{ $person->greetings_count }}件
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
