<?php

$conn = new mysqli("localhost", "root", "", "todo_list");
if ($conn->connect_error) {
    die("Connect Error" . $conn->connect_error);
}
if (isset($_POST['addtask'])) {
    $task = $_POST['task'];
}
