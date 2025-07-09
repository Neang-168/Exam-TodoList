<?php
// 1. Setup
$tasksPerPage = 4;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $tasksPerPage;

// 2. Count total
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM tasks");
$totalRow = $totalResult->fetch_assoc();
$totalTasks = $totalRow['total'];
$totalPages = ceil($totalTasks / $tasksPerPage);

// 3. Select only this page
$stmt = $conn->prepare("SELECT * FROM tasks ORDER BY id DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $tasksPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
