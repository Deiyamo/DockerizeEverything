<?php

function ensureHttpMethod(string $method) : void
{
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        http_response_code(400);
        die();
    }
}