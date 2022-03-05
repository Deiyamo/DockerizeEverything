<?php
require_once __DIR__ . '/../../utils/database.php';
require_once __DIR__ . '/../../utils/server.php';
require_once __DIR__ . '/../../utils/data.php';

ensureHttpMethod('PATCH');

$body = file_get_contents("php://input");
$_PATCH = json_decode($body, true);

$allowedFields = ['title', 'author', 'overview', 'picture', 'read_count'];


if (isset($_GET["isbn"])) {
    $connection = getDatabaseConnection();
    $book = databaseFindOne($connection,
        "SELECT isbn FROM Book WHERE isbn = ?",
        [ $_GET["isbn"] ]);

    if ($book !== null) {

        $checkData = checkData($_PATCH);
        if (!empty($checkData)) {
            http_response_code(422);
            header("Content-Type: application/json");
            echo json_encode($checkData);
            die();
        }

        $set = [];
        $params = [];
        foreach ($_PATCH as $field => $param) {
            if (in_array($field, $allowedFields, true)) {
                $set[] = "$field = ?";
                $params[] = $param;
            } else {
                http_response_code(400);
                die();
            }
        }
        // add isbn at the end of the parameters
        $params[] = $_GET["isbn"];

        if(count($set) > 0) { // at least 1 parameter to patch
            $sql = "UPDATE Book SET ". implode(',', $set) ." WHERE isbn = ?";
        } else {
            http_response_code(400);
            die();
        }


        $connection = getDatabaseConnection();
        $affectedRows = databaseExec($connection, $sql, $params);

        if ($affectedRows !== null) {
            if ($affectedRows === 1) {
                //Afficher le nouveau livre
                $book = databaseFindOne($connection,
                    "SELECT isbn, title, author, overview, picture, read_count FROM Book WHERE isbn = ?",
                    [ $_GET["isbn"] ]);

                if ($book !== null) {
                    http_response_code(200);
                    header("Content-Type: application/json");
                    echo json_encode($book);
                }
            } else {
                http_response_code(422);
                echo "The data that you have inserted are the same that the actual.";
            }
        }

    } else {
        http_response_code(404);
        echo "This book has not been found.";
    }
} else {
    http_response_code(400);
}