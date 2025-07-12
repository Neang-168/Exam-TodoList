<?php
$status = isset($_GET['status']) ? trim($_GET['status']) : '';
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
// base query
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 4;
$offset = ($page - 1) * $itemsPerPage;

$itemsPerPage = (int)$itemsPerPage;
$offset = (int)$offset;

$sql = "SELECT * FROM tasks WHERE 1=1";
$params = [];
$types = "";

// Filtering
if ($status !== '') {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

if ($query !== '') {
    $sql .= " AND task LIKE ?";
    $params[] = "%" . $query . "%";
    $types .= "s";
}
$sql .= " LIMIT $itemsPerPage OFFSET $offset";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
