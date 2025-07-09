<?php
require '../Database.php';

if (isset($_POST['id'], $_POST['newstatus'])) {
    $id = $_POST['id'];
    $newstatus = $_POST['newstatus'];

    $stmt = $conn->prepare("UPDATE tasks SET status=? WHERE id=?");
    $stmt->bind_param("si", $newstatus, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../index.php");
exit;
