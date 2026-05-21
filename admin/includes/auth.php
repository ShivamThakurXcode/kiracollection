<?php
require_once __DIR__ . '/db.php';

function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_after'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
        exit;
    }
}

function login($username, $password) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM admins WHERE username = ? OR email = ? LIMIT 1");
    $stmt->execute([$username, $username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_name'] = $admin['name'] ?? $admin['username'];
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
}

function getCurrentAdmin() {
    if (!isset($_SESSION['admin_id'])) return null;
    $db = getDB();
    $stmt = $db->prepare("SELECT id, username, email, name FROM admins WHERE id = ?");
    $stmt->execute([$_SESSION['admin_id']]);
    return $stmt->fetch();
}
