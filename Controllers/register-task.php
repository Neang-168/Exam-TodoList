<?php
require '../Database.php';

$errors = [];
$email = '';
$password = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate password
    if (strlen($password) < 7) {
        $errors['password'] = "Password must be at least 7 characters.";
    }
    // Check if email is already registered
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errors['email'] = "Email already exists.";
    }

    $stmt->close();

    if (empty($errors)) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            // Success redirect
            header('Location: ../Views/login-task.view.php');
            exit;
        } else {
            if ($conn->errno === 1062) {
                $errors['email'] = "Email already exists.";
            } else {
                $errors['general'] = "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    }
}

include '../Views/register-task.view.php';
