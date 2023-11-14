<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/crud.php');

$db = new Database();
$db->connect();

if (empty($_POST['bank_name']) || empty($_POST['district_name']) || empty($_POST['city_name']) || empty($_POST['branch'])) {
    $response['success'] = false;
    $response['message'] = "Bank Name, District, City, or Branch is Empty";
    print_r(json_encode($response));
    return false;
}

$bank_name = $db->escapeString($_POST['bank_name']);
$district_name = $db->escapeString($_POST['district_name']);
$city_name = $db->escapeString($_POST['city_name']);
$branch = $db->escapeString($_POST['branch']);

// Query to get a list of distinct districts, cities, and branches based on the provided criteria, excluding bank_name
$sql = "SELECT DISTINCT ic.*, c.city_name, s.state_name, d.district_name,b.bank_name
        FROM tbl_ifsc_code ic
        JOIN tbl_bank b ON ic.bank_id = b.bank_id
        JOIN tbl_ifsc_state s ON ic.state_id = s.state_id
        JOIN tbl_city c ON ic.city_id = c.city_id
        JOIN tbl_district d ON ic.district_id = d.district_id
        WHERE b.bank_name = '$bank_name' AND d.district_name = '$district_name' AND c.city_name = '$city_name' AND ic.branch = '$branch'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp = array();
        $temp['ifsc_code_id'] = $row['ifsc_code_id'];
        $temp['address'] = $row['address'];
        $temp['branch'] = $row['branch'];
        $temp['state_name'] = $row['state_name'];
        $temp['district_name'] = $row['district_name'];
        $temp['city_name'] = $row['city_name']; 
        $temp['contact_num'] = $row['contact_num'];
        $temp['ifsc_code'] = $row['ifsc_code'];
        $temp['bank_name'] = $row['bank_name'];
        $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "IFSC Codes Listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "Data Not Found";
    print_r(json_encode($response));
}

?>
