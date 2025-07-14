<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: Views/login-task.view.php'); // redirect to login page
    exit();
}
require 'Partails/header.php';
require 'Database.php';
require 'Controllers/pagination.php';
require 'Partails/fillter-status.php';

?>
<?php
$status = isset($_GET['status']) ? trim($_GET['status']) : '';
?>
<div>
    <?php require 'Partails/nav.php' ?>
</div>
<div class="container">
    <div>
        <div class="search">
            <form method="GET" style="display: flex; align-items: center; gap: 10px;">
                <!-- <input type="text" name="query" id="query" placeholder="Search tasks..."> -->
                <select name="status" id="status">
                    <option value="" <?= $status === '' ? 'selected' : '' ?>>All</option>
                    <option value="todo" <?= $status === 'todo' ? 'selected' : '' ?>>Todo</option>
                    <option value="inprocess" <?= $status === 'inprocess' ? 'selected' : '' ?>>Inprocess</option>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </form>
            <script>
                document.getElementById('status').addEventListener('change', function() {
                    this.form.submit();
                });
                document.getElementById('status-filter').addEventListener('change', function() {
                    const params = new URLSearchParams(window.location.search);
                    params.set('status', this.value);
                    window.location.search = params.toString();
                });
            </script>
            <a href="Views/create-task.view.php" class="btn-add-task">Add Task</a>
        </div>
        <p></p>
    </div>
    <div>
        <?php require 'Views/index.view.php'; ?>
        <?php require 'Views/pagination.view.php'; ?>
    </div>
</div>
<?php require 'Partails/footer.php'; ?>