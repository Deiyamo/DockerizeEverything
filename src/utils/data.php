<?php

function checkData(array $data): ?array
{
    $error = [];

    if (isset($data["isbn"])) {
        if (!checkString($data["isbn"], 13))
            $error[] = "The isbn code must be a string and not exceed 13 characters.";
    }
    if (isset($data["title"])) {
        if (!checkString($data["title"], 200))
            $error[] = "The title must be a string and not exceed 200 characters.";
    }
    if (isset($data["author"])) {
        if (!checkString($data["author"], 150))
            $error[] = "The author name must be a string and not exceed 150 characters.";
    }
    if (isset($data["overview"])) {
        if (!checkString($data["overview"], 1500))
            $error[] = "(Optional)The overview must be a string and not exceed 1500 characters.";
    }

    if (isset($data["picture"])) {
        if (!checkPicture($data["picture"]))
            $error[] = "(Optional)The picture must be a file and among these extensions (.jpg, .png, .gif, .svg).";
    }
    if (isset($data["read_count"])) {
        if (!is_int($data["read_count"]))
            $error[] = "(Optional)The read counter must be an integer.";
    }

    return $error;
}

function checkString($data, $size): bool
{
    if (!is_string($data)) {
        return false;
    }
    if (strlen($data) < 0 || strlen($data) > $size) {
        return false;
    }

    return true;
}

function checkPicture($data): bool
{
    if (!is_file($data)) {
        return false;
    }

    $allowedExtensions = ['jpg', 'png', 'gif', 'svg'];

    $ext = pathinfo($data, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowedExtensions, true)) {
        return false;
    }
    return true;
}
