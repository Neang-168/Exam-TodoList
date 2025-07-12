<?php
require '../Database.php';
if (isset($_POST['id'], $_POST['newstatus'])) {
    $id = (int) $_POST['id'];
    $newstatus = trim($_POST['newstatus']);

    if (in_array($newstatus, ['todo', 'inprocess', 'completed'])) {
        $stmt = $conn->prepare("UPDATE tasks SET status=? WHERE id=?");
        $stmt->bind_param("si", $newstatus, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Preserve page, status, query in redirect
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$status = isset($_POST['status']) ? urlencode($_POST['status']) : '';
$query = isset($_POST['query']) ? urlencode($_POST['query']) : '';

header("Location: ../index.php?page=$page&status=$status&query=$query");
exit;
