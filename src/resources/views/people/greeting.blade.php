<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $person['name'] }}さんへの挨拶</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            width: 100%;
        }

        .greeting-card {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .greeting-icon {
            font-size: 5rem;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .person-name {
            color: #667eea;
            font-weight: bold;
        }

        .greeting-message {
            color: #666;
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .person-details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }

        .detail-value {
            color: #333;
        }

        .button-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: bold;
            transition: opacity 0.3s ease;
        }

        .button:hover {
            opacity: 0.9;
        }

        .button-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .button-secondary {
            background: #f0f0f0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="greeting-card">
            <div class="greeting-icon">👋</div>

            <h1>こんにちは、<br><span class="person-name">{{ $person['name'] }}</span>さん！</h1>

            <p class="greeting-message">
                お会いできて嬉しいです。<br>
                素敵な一日をお過ごしください！
            </p>

            <div class="person-details">
                <div class="detail-item">
                    <span class="detail-label">お名前</span>
                    <span class="detail-value">{{ $person['name'] }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">年齢</span>
                    <span class="detail-value">{{ $person['age'] }}歳</span>
                </div>
            </div>

            <div class="button-group">
                <a href="/people" class="button button-primary">← 人一覧に戻る</a>
                <a href="/" class="button button-secondary">トップページ</a>
            </div>
        </div>
    </div>
</body>
</html>
