<?php
session_start();
require '../Database.php';

// 1️⃣ Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Views/login-task.view.php");
    exit;
}

// 2️⃣ Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'], $_POST['start_date'], $_POST['due_date'])) {
    $task = trim($_POST['task']);
    $start_date = $_POST['start_date'];
    $due_date = $_POST['due_date'];
    $user_id = $_SESSION['user_id'];

    // 3️⃣ Validate dates
    if ($start_date > $due_date) {
        $errorMessage = "Start date cannot be after due date!";
        $backLink = "../Views/create-task.view.php";
        require '../Views/error-date.php';
        exit;
    }

    // 4️⃣ Insert into DB with status 'todo'
    $stmt = $conn->prepare(
        "INSERT INTO tasks (task, start_date, due_date, status, user_id) VALUES (?, ?, ?, 'todo', ?)"
    );
    $stmt->bind_param("sssi", $task, $start_date, $due_date, $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../index.php");
        exit;
    } else {
        $stmt->close();
        die("Database Error: " . $conn->error);
    }
} else {
    // 5️⃣ If accessed directly, redirect to form
    header("Location: ../Views/create-task.view.php");
    exit;
}
