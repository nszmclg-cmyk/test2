<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>API Playground</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .tab-button {
            flex: 1;
            padding: 15px 30px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-button:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .tab-button.active {
            background: white;
            color: #667eea;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .api-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .api-section h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        button {
            padding: 12px 24px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-right: 10px;
        }

        button:hover {
            background: #5568d3;
        }

        button.danger {
            background: #e74c3c;
        }

        button.danger:hover {
            background: #c0392b;
        }

        .results {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            min-height: 50px;
        }

        .card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .card h3 {
            color: #667eea;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
            color: #555;
        }

        .success-message {
            padding: 10px;
            background: #d4edda;
            color: #155724;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .error-message {
            padding: 10px;
            background: #f8d7da;
            color: #721c24;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #667eea;
            font-style: italic;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .tabs {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>API Playground</h1>

        <div class="tabs">
            <button class="tab-button active" data-tab="people">People API</button>
            <button class="tab-button" data-tab="greetings">Greetings API</button>
        </div>

        <!-- People Tab -->
        <div class="tab-content active" id="people-tab">
            <!-- 一覧表示 -->
            <div class="api-section">
                <h2>People 一覧取得</h2>
                <button onclick="fetchPeople()">取得</button>
                <div id="people-list" class="results"></div>
            </div>

            <!-- 作成フォーム -->
            <div class="api-section">
                <h2>Person 作成</h2>
                <form id="create-person-form" onsubmit="createPerson(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="person-name">名前</label>
                            <input type="text" id="person-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="person-age">年齢</label>
                            <input type="number" id="person-age" name="age" min="0" max="150" required>
                        </div>
                    </div>
                    <button type="submit">作成</button>
                </form>
                <div id="create-person-result" class="results"></div>
            </div>

            <!-- 詳細取得 -->
            <div class="api-section">
                <h2>Person 詳細取得</h2>
                <div class="form-group">
                    <label for="show-person-id">Person ID</label>
                    <input type="number" id="show-person-id" min="1">
                </div>
                <button onclick="showPerson()">詳細を取得</button>
                <div id="show-person-result" class="results"></div>
            </div>

            <!-- 更新・削除 -->
            <div class="api-section">
                <h2>Person 更新・削除</h2>
                <div class="form-group">
                    <label for="update-person-id">Person ID</label>
                    <input type="number" id="update-person-id" min="1">
                </div>
                <form id="update-person-form" onsubmit="updatePerson(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="update-person-name">名前</label>
                            <input type="text" id="update-person-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="update-person-age">年齢</label>
                            <input type="number" id="update-person-age" name="age" min="0" max="150" required>
                        </div>
                    </div>
                    <button type="submit">更新</button>
                    <button type="button" class="danger" onclick="deletePerson()">削除</button>
                </form>
                <div id="update-person-result" class="results"></div>
            </div>
        </div>

        <!-- Greetings Tab -->
        <div class="tab-content" id="greetings-tab">
            <!-- 一覧表示 -->
            <div class="api-section">
                <h2>Greetings 一覧取得</h2>
                <button onclick="fetchGreetings()">取得</button>
                <div id="greetings-list" class="results"></div>
            </div>

            <!-- 作成フォーム -->
            <div class="api-section">
                <h2>Greeting 作成</h2>
                <form id="create-greeting-form" onsubmit="createGreeting(event)">
                    <div class="form-group">
                        <label for="greeting-person-id">Person ID</label>
                        <input type="number" id="greeting-person-id" name="person_id" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="greeting-message">メッセージ</label>
                        <textarea id="greeting-message" name="message" maxlength="1000" required></textarea>
                    </div>
                    <button type="submit">作成</button>
                </form>
                <div id="create-greeting-result" class="results"></div>
            </div>

            <!-- 詳細取得 -->
            <div class="api-section">
                <h2>Greeting 詳細取得</h2>
                <div class="form-group">
                    <label for="show-greeting-id">Greeting ID</label>
                    <input type="number" id="show-greeting-id" min="1">
                </div>
                <button onclick="showGreeting()">詳細を取得</button>
                <div id="show-greeting-result" class="results"></div>
            </div>

            <!-- 更新・削除 -->
            <div class="api-section">
                <h2>Greeting 更新・削除</h2>
                <div class="form-group">
                    <label for="update-greeting-id">Greeting ID</label>
                    <input type="number" id="update-greeting-id" min="1">
                </div>
                <form id="update-greeting-form" onsubmit="updateGreeting(event)">
                    <div class="form-group">
                        <label for="update-greeting-person-id">Person ID</label>
                        <input type="number" id="update-greeting-person-id" name="person_id" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="update-greeting-message">メッセージ</label>
                        <textarea id="update-greeting-message" name="message" maxlength="1000" required></textarea>
                    </div>
                    <button type="submit">更新</button>
                    <button type="button" class="danger" onclick="deleteGreeting()">削除</button>
                </form>
                <div id="update-greeting-result" class="results"></div>
            </div>
        </div>
    </div>

    <script>
        // タブ切り替え
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.dataset.tab;

                // すべてのタブボタンとコンテンツから active を削除
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

                // クリックされたタブをアクティブに
                button.classList.add('active');
                document.getElementById(tabName + '-tab').classList.add('active');
            });
        });

        // API基本設定
        const API_BASE_URL = '/api/v1';

        // 共通リクエスト関数
        async function apiRequest(url, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            };

            try {
                const response = await fetch(API_BASE_URL + url, {
                    ...defaultOptions,
                    ...options,
                    headers: { ...defaultOptions.headers, ...options.headers }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'APIエラーが発生しました');
                }

                return data;
            } catch (error) {
                console.error('API Request Error:', error);
                throw error;
            }
        }

        // =========================
        // People API 操作
        // =========================

        async function fetchPeople() {
            const container = document.getElementById('people-list');
            container.innerHTML = '<div class="loading">読み込み中...</div>';

            try {
                const data = await apiRequest('/people');

                if (data.data.length === 0) {
                    container.innerHTML = '<p>データがありません</p>';
                    return;
                }

                container.innerHTML = data.data.map(person => `
                    <div class="card">
                        <h3>${person.name}</h3>
                        <p><strong>年齢:</strong> ${person.age}歳</p>
                        <p><strong>挨拶数:</strong> ${person.greetings_count || 0}件</p>
                        <p><strong>ID:</strong> ${person.id}</p>
                        <p><small>作成日時: ${new Date(person.created_at).toLocaleString('ja-JP')}</small></p>
                    </div>
                `).join('');
            } catch (error) {
                container.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function createPerson(event) {
            event.preventDefault();
            const resultContainer = document.getElementById('create-person-result');
            resultContainer.innerHTML = '<div class="loading">作成中...</div>';

            const formData = new FormData(event.target);
            const data = {
                name: formData.get('name'),
                age: parseInt(formData.get('age'))
            };

            try {
                const result = await apiRequest('/people', {
                    method: 'POST',
                    body: JSON.stringify(data)
                });

                resultContainer.innerHTML = `
                    <div class="success-message">
                        ${result.message}
                    </div>
                    <div class="card">
                        <h3>${result.data.name}</h3>
                        <p><strong>年齢:</strong> ${result.data.age}歳</p>
                        <p><strong>ID:</strong> ${result.data.id}</p>
                    </div>
                `;

                event.target.reset();
                fetchPeople(); // 一覧を更新
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function showPerson() {
            const id = document.getElementById('show-person-id').value;
            const resultContainer = document.getElementById('show-person-result');

            if (!id) {
                resultContainer.innerHTML = '<div class="error-message">Person IDを入力してください</div>';
                return;
            }

            resultContainer.innerHTML = '<div class="loading">読み込み中...</div>';

            try {
                const result = await apiRequest(`/people/${id}`);

                resultContainer.innerHTML = `
                    <div class="card">
                        <h3>${result.data.name}</h3>
                        <p><strong>年齢:</strong> ${result.data.age}歳</p>
                        <p><strong>ID:</strong> ${result.data.id}</p>
                        <p><strong>挨拶数:</strong> ${result.data.greetings ? result.data.greetings.length : 0}件</p>
                        <p><small>作成日時: ${new Date(result.data.created_at).toLocaleString('ja-JP')}</small></p>
                    </div>
                `;
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function updatePerson(event) {
            event.preventDefault();
            const id = document.getElementById('update-person-id').value;
            const resultContainer = document.getElementById('update-person-result');

            if (!id) {
                resultContainer.innerHTML = '<div class="error-message">Person IDを入力してください</div>';
                return;
            }

            resultContainer.innerHTML = '<div class="loading">更新中...</div>';

            const formData = new FormData(event.target);
            const data = {
                name: formData.get('name'),
                age: parseInt(formData.get('age'))
            };

            try {
                const result = await apiRequest(`/people/${id}`, {
                    method: 'PUT',
                    body: JSON.stringify(data)
                });

                resultContainer.innerHTML = `
                    <div class="success-message">
                        ${result.message}
                    </div>
                    <div class="card">
                        <h3>${result.data.name}</h3>
                        <p><strong>年齢:</strong> ${result.data.age}歳</p>
                        <p><strong>ID:</strong> ${result.data.id}</p>
                    </div>
                `;

                fetchPeople(); // 一覧を更新
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function deletePerson() {
            const id = document.getElementById('update-person-id').value;
            const resultContainer = document.getElementById('update-person-result');

            if (!id) {
                resultContainer.innerHTML = '<div class="error-message">Person IDを入力してください</div>';
                return;
            }

            if (!confirm(`ID ${id} のPersonを削除しますか？`)) {
                return;
            }

            resultContainer.innerHTML = '<div class="loading">削除中...</div>';

            try {
                const result = await apiRequest(`/people/${id}`, {
                    method: 'DELETE'
                });

                resultContainer.innerHTML = `<div class="success-message">${result.message}</div>`;
                document.getElementById('update-person-id').value = '';
                document.getElementById('update-person-form').reset();
                fetchPeople(); // 一覧を更新
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        // =========================
        // Greetings API 操作
        // =========================

        async function fetchGreetings() {
            const container = document.getElementById('greetings-list');
            container.innerHTML = '<div class="loading">読み込み中...</div>';

            try {
                const data = await apiRequest('/greetings');

                if (data.data.length === 0) {
                    container.innerHTML = '<p>データがありません</p>';
                    return;
                }

                container.innerHTML = data.data.map(greeting => `
                    <div class="card">
                        <h3>ID: ${greeting.id}</h3>
                        <p><strong>メッセージ:</strong> ${greeting.message}</p>
                        <p><strong>Person:</strong> ${greeting.person ? greeting.person.name : 'N/A'} (ID: ${greeting.person_id})</p>
                        <p><small>作成日時: ${new Date(greeting.created_at).toLocaleString('ja-JP')}</small></p>
                    </div>
                `).join('');
            } catch (error) {
                container.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function createGreeting(event) {
            event.preventDefault();
            const resultContainer = document.getElementById('create-greeting-result');
            resultContainer.innerHTML = '<div class="loading">作成中...</div>';

            const formData = new FormData(event.target);
            const data = {
                person_id: parseInt(formData.get('person_id')),
                message: formData.get('message')
            };

            try {
                const result = await apiRequest('/greetings', {
                    method: 'POST',
                    body: JSON.stringify(data)
                });

                resultContainer.innerHTML = `
                    <div class="success-message">
                        ${result.message}
                    </div>
                    <div class="card">
                        <h3>ID: ${result.data.id}</h3>
                        <p><strong>メッセージ:</strong> ${result.data.message}</p>
                        <p><strong>Person ID:</strong> ${result.data.person_id}</p>
                    </div>
                `;

                event.target.reset();
                fetchGreetings(); // 一覧を更新
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function showGreeting() {
            const id = document.getElementById('show-greeting-id').value;
            const resultContainer = document.getElementById('show-greeting-result');

            if (!id) {
                resultContainer.innerHTML = '<div class="error-message">Greeting IDを入力してください</div>';
                return;
            }

            resultContainer.innerHTML = '<div class="loading">読み込み中...</div>';

            try {
                const result = await apiRequest(`/greetings/${id}`);

                resultContainer.innerHTML = `
                    <div class="card">
                        <h3>ID: ${result.data.id}</h3>
                        <p><strong>メッセージ:</strong> ${result.data.message}</p>
                        <p><strong>Person:</strong> ${result.data.person ? result.data.person.name : 'N/A'} (ID: ${result.data.person_id})</p>
                        <p><small>作成日時: ${new Date(result.data.created_at).toLocaleString('ja-JP')}</small></p>
                    </div>
                `;
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function updateGreeting(event) {
            event.preventDefault();
            const id = document.getElementById('update-greeting-id').value;
            const resultContainer = document.getElementById('update-greeting-result');

            if (!id) {
                resultContainer.innerHTML = '<div class="error-message">Greeting IDを入力してください</div>';
                return;
            }

            resultContainer.innerHTML = '<div class="loading">更新中...</div>';

            const formData = new FormData(event.target);
            const data = {
                person_id: parseInt(formData.get('person_id')),
                message: formData.get('message')
            };

            try {
                const result = await apiRequest(`/greetings/${id}`, {
                    method: 'PUT',
                    body: JSON.stringify(data)
                });

                resultContainer.innerHTML = `
                    <div class="success-message">
                        ${result.message}
                    </div>
                    <div class="card">
                        <h3>ID: ${result.data.id}</h3>
                        <p><strong>メッセージ:</strong> ${result.data.message}</p>
                        <p><strong>Person ID:</strong> ${result.data.person_id}</p>
                    </div>
                `;

                fetchGreetings(); // 一覧を更新
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }

        async function deleteGreeting() {
            const id = document.getElementById('update-greeting-id').value;
            const resultContainer = document.getElementById('update-greeting-result');

            if (!id) {
                resultContainer.innerHTML = '<div class="error-message">Greeting IDを入力してください</div>';
                return;
            }

            if (!confirm(`ID ${id} のGreetingを削除しますか？`)) {
                return;
            }

            resultContainer.innerHTML = '<div class="loading">削除中...</div>';

            try {
                const result = await apiRequest(`/greetings/${id}`, {
                    method: 'DELETE'
                });

                resultContainer.innerHTML = `<div class="success-message">${result.message}</div>`;
                document.getElementById('update-greeting-id').value = '';
                document.getElementById('update-greeting-form').reset();
                fetchGreetings(); // 一覧を更新
            } catch (error) {
                resultContainer.innerHTML = `<div class="error-message">エラー: ${error.message}</div>`;
            }
        }
    </script>
</body>
</html>
