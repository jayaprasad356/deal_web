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

if (empty($_POST['bank_name']) || empty($_POST['district_name']) ||empty($_POST['city_name']) ) {
    $response['success'] = false;
    $response['message'] = "Bank Name or District or city is Empty";
    print_r(json_encode($response));
    return false;
}

$bank_name = $db->escapeString($_POST['bank_name']);
$district_name = $db->escapeString($_POST['district_name']);
$city_name = $db->escapeString($_POST['city_name']);

// Query to get a list of distinct districts based on the provided bank_name and district
$sql = "SELECT * 
        FROM tbl_ifsc_code ic
        JOIN tbl_bank b ON ic.bank_id = b.bank_id
        JOIN tbl_ifsc_state s ON ic.state_id = s.state_id
        JOIN tbl_city c ON ic.city_id = c.city_id
        JOIN tbl_district d ON ic.district_id = d.district_id
        WHERE b.bank_name = '$bank_name' AND d.district_name = '$district_name' AND c.city_name = '$city_name'";
        $db->sql($sql);
        $res = $db->getResult();
        $num = $db->numRows($res);

        if ($num >= 1) {
            $rows = array();
            foreach ($res as $row) {
                $temp = array();
                $temp['ifsc_code_id'] = $row['ifsc_code_id'];
                $temp['district_name'] = $row['district_name'];
                $temp['city_name'] = $row['city_name'];
                $temp['branch'] = $row['branch'];
                $rows[] = $temp;
            }
    $response['success'] = true;
    $response['message'] = "District and City , Branch List Retrieved Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "No Districts and Cities and Branch Found for the Bank";
    print_r(json_encode($response));
}
?>
