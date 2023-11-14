<?php
function escape($string) {
	$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	return $string;
}
// -- returns seo friendly url
function seoUrl($s) {
    return strtolower(str_replace(' ', '-', $s));
}
function mapUrl($s) {
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $s));
}
function imgUrl($s) {
    return strtolower(str_replace(' ', '_', $s));
}
// -- sanitize user inputs
function filterInput($s) {
    global $dbconn;
    return strip_tags(ucwords(str_replace("-", " ", mysqli_real_escape_string($dbconn, trim($s)))));
}

// -- returns current url
function currentUrl() {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	return $actual_link;
}