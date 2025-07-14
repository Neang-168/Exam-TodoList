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
<style>
    body {
        background: #f3f3f3;
        padding: 0;
        margin: 0;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-left: 40px;
    }

    .container-create {
        max-width: 400px;
        /* nice small card width */
        margin: 40px auto;
        /* center horizontally */
        padding: 20px;
        /* inner spacing */
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .lb-label {
        font-weight: bold;
        display: block;
        text-align: start;
        justify-content: start;
    }

    .txt-list {
        margin-top: 10px;
        font-family: "Times New Roman", Times, serif;
        font-weight: bold;
        color: rgb(9, 9, 139);
        font-size: 25px;
    }

    .add-task-form {
        display: flex;
        gap: 10px;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .add-task-form input[type="text"] {
        flex: 1;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    input[type="date"] {
        padding: 10px 12px;
        border: 2px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        color: #333;
        background-color: #fff;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="date"]:focus {
        border-color: #ccc;
        outline: none;
        box-shadow: 0 0 5px rgba(13, 10, 168, 0.4);
    }

    input[type="date"]::placeholder {
        color: #999;
    }

    .btn-add-task {
        background: rgb(3, 3, 128);
        border-radius: 10px;
        padding: 10px 20px;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
        margin-left: 250px;
    }

    .btn-create-task {
        display: block;
        width: 100%;
        padding: 10px 16px;
        text-align: center;
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        background-color: #0357b1;
        /* Blue background */
        color: #fff;
        transition: background-color 0.2s;
        text-decoration: none;
    }

    .header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding: 0 10px;
    }

    .btn-back {
        padding: 8px 12px;
        color: red;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<?php require '../Partails/footer.php';
