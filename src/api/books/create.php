<?php
require_once __DIR__ . '/../../utils/database.php';
require_once __DIR__ . '/../../utils/server.php';
require_once __DIR__ . '/../../utils/data.php';

/*
{
    "isbn": "4U34B",
    "title": "Tim",
    "author": "Voss",
    "overview": "",
    "picture": "",
    "read_count": ""
}
*/

ensureHttpMethod('POST');

$body = file_get_contents("php://input");
$_POST = json_decode($body, true);

$allowedFields = ['isbn', 'title', 'author', 'overview', 'picture', 'read_count'];

if (isset($_POST["isbn"], $_POST["title"], $_POST["author"])) {

    // check data format
    $checkData = checkData($_POST);
    if (!empty($checkData)) {
        http_response_code(422);
        header("Content-Type: application/json");
        echo json_encode($checkData);
        die();
    }

    $connection = getDatabaseConnection();
    $isbnAlreadyExist = databaseFindOne($connection,
                         "SELECT isbn FROM Book WHERE isbn = ?",
                             [$_POST["isbn"]]);

    if ($isbnAlreadyExist === null) {

        $fields = [];
        $params = [];
        $paramsInSql = [];
        foreach ($_POST as $field => $param) {
            if (in_array($field, $allowedFields, true)) {
                $fields[] = $field;
                $paramsInSql[] = "?";
                $params[] = $param;
            } else {
                http_response_code(400);
                die();
            }
        }

        if(count($fields) >= 3) { // at least 3 parameter to create (isbn, title, author)
            $sql = "INSERT INTO Book (". implode(',', $fields) .") VALUES (". implode(',', $paramsInSql) .")";
        } else {
            http_response_code(400);
            die();
        }

        $bookId = databaseInsert($connection, $sql, $params);

        if ($bookId !== null) {
            $book = databaseFindOne($connection,
                                "SELECT isbn, title, author, overview, picture, read_count FROM Book WHERE isbn = ?",
                                    [ $_POST["isbn"] ]);

            if ($book !== null) {
                http_response_code(201);
                header("Content-Type: application/json");
                echo json_encode($book);
            }
        }
    } else {
        http_response_code(422);
        echo "The book with that isbn code: \"". $_POST["isbn"] ."\" already exists.";
    }

} else {
    http_response_code(400);
}