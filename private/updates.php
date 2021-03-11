<?php
    if (file_exists("/var/secret/api.elitelooter.com/secret/priv_keys.php")) {
        include_once '/var/secret/api.elitelooter.com/secret/priv_keys.php';
    } else {
        include_once dirname(__FILE__) . '/../secret/priv_keys.php';
    }
    require(dirname(__FILE__) . '/../util.php');

    // Check if the request is authorized
    if (getAuthHeader(apache_request_headers()) != $updates_key) { errorAndExit(null, "HTTP/1.1 401 UNAUTHORIZED"); }

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    if ($requestMethod == "GET") {
        if (isset($_GET["data"]) && $_GET["data"] == "nextupdate") {
            header("Content-Type:application/json");
            echo json_encode(array("update_known" => false,
                            "update_version" => "4.0-alpha-1",
                            "short_description" => "The first alpha release of elite looter. Currently doesn't have a release date yet.",
                            "long_description" => "Aha, there should be a changelog here. But we literally started from scratch, so nothing to be found here."));
            exit;
        }
    } else { errorAndExit(null, "HTTP/1.1 405 METHOD NOT ALLOWED"); }

    errorAndExit(null, "HTTP/1.1 404 NOT FOUND");
