<?php require 'Partails/header.php'; ?>
<?php require 'Database.php'; ?>
<?php

if (!isset($_GET['id'])) {
    die('Task ID is required.');
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die('Task not found.');
}

$task = $result->fetch_assoc();
$stmt->close();
?>
<div class="container">
    <div>
        <form action="Controllers/update.php" method="POST" class="add-task-form">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="text" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
            <input type="date" name="start_date" value="<?= $task['start_date'] ?>">
            <input type="date" name="due_date" value="<?= $task['due_date'] ?>">
            <button class="btn-add-task">Update</button>
            <a href="index.php" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                Back
            </a>
        </form>
    </div>
</div>