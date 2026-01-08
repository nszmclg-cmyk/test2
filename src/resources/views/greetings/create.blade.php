<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>挨拶を追加</title>
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
            max-width: 600px;
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

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        select, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .error {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .button {
            flex: 1;
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: opacity 0.3s ease;
            text-decoration: none;
            text-align: center;
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

        .empty-state {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .empty-state-text {
            color: #856404;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('greetings.index') }}" class="back-link">← 挨拶一覧に戻る</a>

        <h1>挨拶を追加</h1>

        @if($people->isEmpty())
            <div class="empty-state">
                <div class="empty-state-text">
                    まだ人が登録されていません。<br>
                    先にTinkerで人を登録してください。
                </div>
            </div>
        @else
            <div class="form-card">
                <form action="{{ route('greetings.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="person_id">誰に挨拶しますか？</label>
                        <select name="person_id" id="person_id" required>
                            <option value="">選択してください</option>
                            @foreach($people as $person)
                                <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                                    {{ $person->name }} ({{ $person->age }}歳)
                                </option>
                            @endforeach
                        </select>
                        @error('person_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">挨拶メッセージ</label>
                        <textarea name="message" id="message" required placeholder="挨拶のメッセージを入力してください...">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="button-group">
                        <a href="{{ route('greetings.index') }}" class="button button-secondary">キャンセル</a>
                        <button type="submit" class="button button-primary">追加する</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</body>
</html>
