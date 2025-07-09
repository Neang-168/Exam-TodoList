<?php
require '../Database.php';

if (isset($_POST['task'], $_POST['start_date'], $_POST['due_date'])) {
    $task = trim($_POST['task']);
    $start_date = $_POST['start_date'];
    $due_date = $_POST['due_date'];

    if ($start_date > $due_date) {
        $errorMessage = "Start date cannot be after due date!";
        $backLink = "../index.php";
        require '../Views/error-date.php';
        exit;
    }
}
$stmt = $conn->prepare("INSERT INTO tasks (task, start_date, due_date, status) VALUES (?, ?, ?, '')");
$stmt->bind_param("sss", $task, $start_date, $due_date);
$stmt->execute();
$stmt->close();

header("Location: ../index.php");
exit;
