<?php
require '../Database.php';

if (isset($_POST['id'], $_POST['task'], $_POST['start_date'], $_POST['due_date'])) {
    $id = $_POST['id'];
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
$stmt = $conn->prepare("UPDATE tasks SET task = ?, start_date = ?, due_date = ? WHERE id = ?");
$stmt->bind_param("sssi", $task, $start_date, $due_date, $id);
$stmt->execute();
$stmt->close();

header("Location: ../index.php");
exit;
