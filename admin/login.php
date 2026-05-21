<?php
session_start();
require_once __DIR__ . '/includes/auth.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } elseif (login($username, $password)) {
        $redirect = $_SESSION['redirect_after'] ?? 'index.php';
        unset($_SESSION['redirect_after']);
        header("Location: $redirect");
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - KiraCollection Art</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Urbanist:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: #fffbeb;
            color: #212529;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .mandala-bg {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
            overflow: hidden;
            opacity: 0.06;
        }
        .mandala-bg svg {
            position: absolute;
            width: 600px;
            height: 600px;
        }
        .mandala-bg svg:nth-child(1) { top: -150px; right: -150px; transform: rotate(15deg); }
        .mandala-bg svg:nth-child(2) { bottom: -200px; left: -200px; transform: rotate(-10deg); }
        .mandala-bg svg:nth-child(3) { top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; height: 800px; opacity: 0.4; }
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 24px 48px rgba(145,158,171,0.12);
            border: 1px solid #dfe3e8;
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-header .mandala-icon {
            margin-bottom: 16px;
        }
        .login-header h1 {
            font-family: 'Urbanist', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #556b2f;
        }
        .login-header h1 span {
            color: #daa520;
        }
        .login-header p {
            color: #495057;
            font-size: 14px;
            margin-top: 4px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #dfe3e8;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: #212529;
            background: #fffbeb;
            transition: all 0.2s ease;
            outline: none;
        }
        .form-group input:focus {
            border-color: #556b2f;
            box-shadow: 0 0 0 3px rgba(85,107,47,0.12);
            background: #fff;
        }
        .form-group input::placeholder {
            color: #919eab;
        }
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .form-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #495057;
            cursor: pointer;
        }
        .form-options input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #556b2f;
        }
        .form-options a {
            font-size: 13px;
            color: #556b2f;
            text-decoration: none;
            font-weight: 500;
        }
        .form-options a:hover {
            color: #3d5a1f;
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #556b2f;
            color: #fff;
            border: none;
            border-radius: 60px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            background: #3d5a1f;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(85,107,47,0.24);
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .error-msg {
            background: #fcd1ca;
            border: 1px solid #ef6168;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            color: #ae013c;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #f4f6f8;
        }
        .login-footer a {
            color: #495057;
            font-size: 13px;
            text-decoration: none;
        }
        .login-footer a:hover {
            color: #556b2f;
        }
        .decor-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #556b2f, #daa520);
            border-radius: 2px;
            margin: 0 auto 20px;
        }
        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>
    <!-- Mandala background pattern -->
    <div class="mandala-bg">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="48" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="40" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="32" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="24" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="16" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="8" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="3" stroke="#556b2f" stroke-width="0.5" fill="none"/>
        </svg>
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="48" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="40" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="32" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="24" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="16" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="8" stroke="#556b2f" stroke-width="0.5" fill="none"/>
            <circle cx="50" cy="50" r="3" stroke="#556b2f" stroke-width="0.5" fill="none"/>
        </svg>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="mandala-icon">
                    <svg width="48" height="48" viewBox="0 0 100 100" fill="none">
                        <circle cx="50" cy="50" r="45" stroke="#556b2f" stroke-width="1.5" fill="none"/>
                        <circle cx="50" cy="50" r="30" stroke="#556b2f" stroke-width="1.5" fill="none"/>
                        <circle cx="50" cy="50" r="15" stroke="#556b2f" stroke-width="1" fill="none"/>
                        <circle cx="50" cy="50" r="5" fill="#daa520"/>
                        <line x1="50" y1="5" x2="50" y2="20" stroke="#556b2f" stroke-width="1"/>
                        <line x1="50" y1="80" x2="50" y2="95" stroke="#556b2f" stroke-width="1"/>
                        <line x1="5" y1="50" x2="20" y2="50" stroke="#556b2f" stroke-width="1"/>
                        <line x1="80" y1="50" x2="95" y2="50" stroke="#556b2f" stroke-width="1"/>
                        <path d="M50 5 A45 45 0 0 1 95 50" stroke="#daa520" stroke-width="0.5" fill="none" opacity="0.5"/>
                        <path d="M50 95 A45 45 0 0 1 5 50" stroke="#daa520" stroke-width="0.5" fill="none" opacity="0.5"/>
                    </svg>
                </div>
                <h1>Kira<span>Collection</span></h1>
                <p>Admin Panel</p>
                <div class="decor-line"></div>
            </div>

            <?php if ($error): ?>
                <div class="error-msg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ae013c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username or email" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    Sign In
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path dM12 5l7 7-7 7"/></svg>
                </button>
            </form>

            <div class="login-footer">
                <a href="../index.php">← Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>
