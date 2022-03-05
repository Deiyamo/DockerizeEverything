<?php

require_once __DIR__ . '/../../utils/database.php';
require_once __DIR__ . '/../../utils/server.php';

ensureHttpMethod('DELETE');

if (isset($_GET["isbn"])) {
    $connection = getDatabaseConnection();
    $affectedRows = databaseExec($connection,
                             "DELETE FROM Book WHERE isbn = ?",
                                 [ $_GET["isbn"] ]);

    if ($affectedRows !== null) {
        if ($affectedRows === 1) {
            http_response_code(204);
            header('Content-length: 0');
        } else {
            http_response_code(404);
            echo "You can't delete a book that doesn't exist.";
        }
    } else {
        http_response_code(500);
    }

} else {
    http_response_code(400);
}