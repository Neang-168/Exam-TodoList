<?php
require 'Partails/header.php';
require 'Database.php';
require 'Controllers/pagination.php';
?>
<div>
    <h1 class="head-text">
        Todo List
    </h1>
</div>
<div class="container">
    <div>
        <?php require 'Views/create-task.view.php'; ?>
    </div>
    <div>
        <h2 class="txt-list">Task List</h2>
    </div>
    <div>
        <?php require 'Views/index.view.php'; ?>
        <?php require 'Views/pagination.view.php'; ?>
    </div>
</div>
<?php require 'Partails/footer.php'; ?>