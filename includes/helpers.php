<?php

function redirect_to($url = "index.php") {
    header("Location: {$url}");
    exit;
}

?>