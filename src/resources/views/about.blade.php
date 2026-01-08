<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Laravelアプリケーション</title>
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
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 800px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #667eea;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin-top: 30px;
            border-radius: 8px;
        }

        .info-box h2 {
            color: #764ba2;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .links {
            margin-top: 30px;
            text-align: center;
        }

        .links a {
            display: inline-block;
            padding: 12px 30px;
            margin: 10px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .links a:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        ul {
            margin: 20px 0;
            padding-left: 30px;
        }

        li {
            margin: 10px 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About ページ</h1>

        <p>このページはLaravelのビューを返すルートのデモページです。</p>

        <div class="info-box">
            <h2>このアプリケーションについて</h2>
            <p>このLaravelアプリケーションは以下の技術を使用しています：</p>
            <ul>
                <li>Laravel 12 - PHPフレームワーク</li>
                <li>Vite 7 - アセットビルド</li>
                <li>Tailwind CSS 4 - CSSフレームワーク</li>
                <li>SQLite - データベース</li>
                <li>PHPUnit - テストフレームワーク</li>
            </ul>
        </div>

        <div class="info-box">
            <h2>利用可能なルート</h2>
            <ul>
                <li><strong>/</strong> - ウェルカムページ</li>
                <li><strong>/hello</strong> - 文字列を返すルート</li>
                <li><strong>/about</strong> - このAboutページ（ビューを返すルート）</li>
            </ul>
        </div>

        <div class="links">
            <a href="/">ホームに戻る</a>
            <a href="/hello">Helloページへ</a>
        </div>
    </div>
</body>
</html>
