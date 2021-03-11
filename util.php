<?php
function errorAndExit($error, $header = "HTTP/1.1 500 INTERNAL SERVER ERROR") {
    header($header);
    echo $error;
    exit;
}

function getAuthHeader($headers) {
    if (isset($headers["Authorization"])) {
        return $headers["Authorization"];
    }

    return null;
}