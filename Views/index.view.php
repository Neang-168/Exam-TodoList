<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this task?');
    }
</script>
<?php
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

if ($result->num_rows > 0) {
    echo "<table class='task-table'>";
    echo "<thead>
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
          </thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        $currentStatus = strtolower(trim($row['status'] ?? ''));
        if ($currentStatus === '' || $currentStatus === null) {
            $currentStatus = 'todo';
        }
        $statusClass = $currentStatus;

        echo "<tr class='{$statusClass}'>";

        // ID
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";

        // Task
        echo "<td>" . htmlspecialchars($row['task']) . "</td>";

        // Start Date
        echo "<td>" . (!empty($row['start_date']) ? htmlspecialchars($row['start_date']) : '-') . "</td>";

        // Due Date
        echo "<td>" . (!empty($row['due_date']) ? htmlspecialchars($row['due_date']) : '-') . "</td>";
        echo "<td style='vertical-align: middle;'>
        <form method='POST' action='Controllers/update-task.php' style='display:inline;'>
        <input type='hidden' name='id' value='" . $row['id'] . "'>
        <!-- ADD THESE LINES: -->
        <input type='hidden' name='page' value='" . htmlspecialchars($page) . "'>
        <input type='hidden' name='status' value='" . htmlspecialchars($status) . "'>
        <input type='hidden' name='query' value='" . htmlspecialchars($query) . "'>
        <select name='newstatus' onchange='this.form.submit()' class='select-status' >
            <option value='todo' " . ($currentStatus === 'todo' ? 'selected' : '') . ">Todo</option>
            <option value='inprocess' " . ($currentStatus === 'inprocess' ? 'selected' : '') . ">Inprocess</option>
            <option value='completed' " . ($currentStatus === 'completed' ? 'selected' : '') . ">Completed</option>
        </select>
        </form>
        </td>";

        // ACTIONS column: Update and Delete forms
        echo "<td class='task-actions'>";

        // Update form
        echo "<form class='btn-update' method='GET' action='edit-task.php' >
        <input type='hidden' name='id' value='" . $row['id'] . "'>
        <button type='submit'>Update</button>
        </form>";

        // Delete form
        echo "<form class='btn-delete' method='POST' action='Controllers/delete-task.php' onsubmit='return confirmDelete()'>
        <input type='hidden' name='id' value='" . $row['id'] . "'>
        <button type='submit'>Delete</button>
        </form>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    require 'Partails/empty-task.php';
}
