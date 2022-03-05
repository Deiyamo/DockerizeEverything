<?php
require_once __DIR__ . '/../../utils/database.php';
require_once  __DIR__ . '/../../utils/server.php';

ensureHttpMethod('GET');

if (isset($_GET["isbn"])) {
    $connection = getDatabaseConnection();

    $book = databaseFindOne($connection,
                       "SELECT isbn, title, author, overview, picture, read_count FROM Book WHERE isbn = ?",
                           [ $_GET["isbn"] ]);

    if ($book !== null) {
        http_response_code(200);
        header("Content-Type: application/json");
        echo json_encode($book);
    } else {
        http_response_code(404);
        echo "This book has not been found.";
    }

} else {
    http_response_code(400);
}