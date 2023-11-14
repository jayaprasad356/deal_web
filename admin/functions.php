<?php

// -- returns seo friendly url
function seoUrl($s) {
    return strtolower(str_replace(' ', '_', $s));
}

// -- sanitize user inputs
function filterInput($s) {
    global $dbconn;
    return strip_tags(ucwords(str_replace("_", " ", mysqli_real_escape_string($dbconn, trim($s)))));
}

// -- returns current url
function currentUrl() {
    return (($_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . $_SERVER[HTTP_HOST] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}