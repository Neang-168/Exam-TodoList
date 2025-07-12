<?php require 'Partails/header.php'; ?>
<?php require 'Database.php'; ?>
<?php
$today = date('Y-m-d');
?>
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
<div class="container-create">
    <div>
        <form action="Controllers/update.php" method="POST" class="add-task-form">
            <div class="header-bar">
                <h1 class="txt-list">Update Task</h1>
                <a href="index.php" style="color: red; font-size: 24px;">❌</a>
            </div>
            <hr>
            <label for="task" class="lb-label">Task : </label>
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="text" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
            <label for="" class="lb-label">Start Date :</label>
            <input type="date" name="start_date" id="start_date" value="<?= $task['start_date'] ?>">
            <label for="" class="lb-label">Due Date :</label>
            <input type="date" name="due_date" id="due_date" value="<?= $task['due_date'] ?>">
            <button class="btn-create-task">Update</button>

        </form>
    </div>
</div>
<script>
    const startDate = document.getElementById('start_date');
    const dueDate = document.getElementById('due_date');

    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    dueDate.min = today;

    startDate.addEventListener('change', () => {
        dueDate.min = startDate.value;
        if (dueDate.value < startDate.value) {
            dueDate.value = '';
        }
    });
</script>