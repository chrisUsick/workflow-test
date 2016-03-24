<?php

function redirect_to($url = "index.php") {
    header("Location: {$url}");
    exit;
}

function safe_get_id() {
    return filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
}

?>