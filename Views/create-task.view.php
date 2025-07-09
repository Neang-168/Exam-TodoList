<form action="Controllers/create-task.php" method="POST" class="add-task-form">
    <label for="task" class="lb-label">Task : </label>
    <input type="text" placeholder="Enter new task" name="task" required>
    <label for="" class="lb-label">Start :</label>
    <input type="date" name="start_date" required placeholder="Start Date">
    <label for="" class="lb-label">Due :</label>
    <input type="date" name="due_date" required placeholder="Due Date">
    <button class="btn-add-task" type="submit">Add Task</button>
</form>