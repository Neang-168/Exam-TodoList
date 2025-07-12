<?php
require '../Partails/header.php';
$today = date('Y-m-d');
?>
<div class="container-create">
    <div>
        <form action="../Controllers/create-task.php" method="POST" class="add-task-form">
            <div class="header-bar">
                <h1 class="txt-list">Create Task</h1>
                <a href="../index.php" style="color: red; font-size: 24px;">❌</a>
            </div>
            <hr>
            <label for="task" class="lb-label">Task : </label>
            <input type="text" placeholder="Enter new task" name="task" required>
            <label for="" class="lb-label">Start Date :</label>
            <input type="date" name="start_date" id="start_date" required>
            <label for="" class="lb-label">Due Date :</label>
            <input type="date" name="due_date" id="due_date" required>
            <button class="inline-block btn-create-task " type="submit">Add Task</button>
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

<?php require '../Partails/footer.php';
