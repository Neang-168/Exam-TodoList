<?php
session_start();
require '../Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_email'] = $email;
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid password.";
            header("Location: ../Views/login-task.view.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = "Email not found.";
        header("Location: ../Views/login-task.view.php");
        exit;
    }
}

