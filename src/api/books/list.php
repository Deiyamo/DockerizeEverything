<?php
require_once __DIR__ . '/../../utils/database.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('GET');

$connection = getDatabaseConnection();
$rows = databaseFindAll($connection, "SELECT isbn, title, author FROM Book", [ ]);

if ($rows !== null) {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($rows);
} else {
    http_response_code(500);
}