<?php
if ($result->num_rows > 0) {
    echo "<ul class='task-list'>";
    while ($row = $result->fetch_assoc()) {
        $statusClass = $row['status'] === '' ? '' : $row['status'];

        echo "<li class='task-item {$statusClass}'>";

        // Show task text and status if not empty
        echo "<span>" . htmlspecialchars($row['task']);
        if ($row['status'] !== '') {
            echo " (" . htmlspecialchars($row['status']) . ")";
        }

        // Show start and due dates
        if (!empty($row['start_date'])) {
            echo " || Start: " . htmlspecialchars($row['start_date']);
        }
        if (!empty($row['due_date'])) {
            echo " || Due: " . htmlspecialchars($row['due_date']);
        }

        echo "</span>";

        echo "<div class='task-actions'>
                    <form class='inline btn-inprocess' method='POST' action='Controllers/update-task.php'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='newstatus' value='inprocess'>
                        <button type='submit'>In Process</button>
                    </form>

                    <form class='inline btn-complete' method='POST' action='Controllers/update-task.php'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='newstatus' value='completed'>
                        <button type='submit'>Completed</button>
                    </form>

                    <form class='inline btn-update' method='GET' action='edit-task.php'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit'>Update</button>
                    </form>

                    <form class='inline btn-delete' method='POST' action='Controllers/delete-task.php'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit'>Delete</button>
                    </form>
                </div>";

        echo "</li>";
    }
    echo "</ul>";
} else {
    require 'Partails/empty-task.php';
}
