<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            height: 50px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        button {
            width: 100%;
            background: #3490dc;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            cursor: pointer;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div>
        <h2>Aplikasi E-Raport SDN 33 Seluma</h2>
    </div>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
    </div>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login Admin</button>
    </form>
</div>

</body>
</html>
