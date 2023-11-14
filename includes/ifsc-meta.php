<?php require_once('home_rewrite.php'); ?>

<?php

$requestedPage = basename($_SERVER["SCRIPT_FILENAME"], '.php');

if($requestedPage === "index") {
    
    $bankCC = filterInput($_GET['bank']);
    $stateCC = filterInput($_GET['state']);
    $districtCC = filterInput($_GET['district']);
    $branchCC = filterInput($_GET['branch']);
    
    if(!empty($branchCC)) {
        
        // page title, page description and page keywords when bank, state, district and branch selected
		$dbQuery = "SELECT * FROM `bank_details` WHERE `bank_name` = '".$bankCC."' AND `bank_branch` = '".$branchCC."' LIMIT 1";
		
        
    } else if(!empty($districtCC)) {
		
		 // -- fetch districts query
        $dbQuery = "SELECT DISTINCT `bank_name`,`bank_state`,`bank_district`,`bank_branch` FROM `bank_details` WHERE `bank_name` = '".$bankCC."' AND `bank_state` = '".$stateCC."' AND `bank_district` = '".$districtCC."' ORDER BY `bank_branch` ASC";
        
    } else if(!empty($stateCC)) {
		
		 // -- fetch districts query
        $dbQuery = "SELECT DISTINCT `bank_name`,`bank_state`,`bank_district` FROM `bank_details` WHERE `bank_name` = '".$bankCC."' AND `bank_state` = '".$stateCC."' ORDER BY `bank_district` ASC";
        
    } else if(!empty($bankCC)) {
		
		 // -- fetch states query
        $dbQuery = "SELECT DISTINCT `bank_name`,`bank_state` FROM `bank_details` WHERE `bank_name` = '".$bankCC."' ORDER BY `bank_state` ASC";
        

    } else {
        
        // home page title, page description and page keywords
		
		$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{

        $pageTitle = $row['meta_title_home'];
        $pageDescription = $row['meta_description_home'];
        $pageKeywords = $row['meta_keyword_home'];
        }
		
		$hTitle = $row['home_title'];
        $pDescription = $row['home_description'];
		$pContent = $row['home_content'];
        // -- fetch banks query
        $dbQuery = "SELECT DISTINCT `bank_name` FROM `contact_details` ORDER BY `bank_name` ASC";
		
    }
    
    $dbQueryResult = mysqli_query($dbconn, $dbQuery);
    $totalResultsCount = intval(mysqli_num_rows($dbQueryResult));
    $results = array();
    
    if($totalResultsCount > 0) {
       while($singleResult = mysqli_fetch_array($dbQueryResult, MYSQLI_ASSOC)) {
            $results[] = $singleResult;
        }
    } else {
       header("HTTP/1.0 404 Not Found");
	   header('Location: /');
       die;
	}
        
} 
else if($requestedPage === "ifsccode") {
    
    		// Getting the news detailed data from the news id
$statement = $pdo->prepare("SELECT * FROM bank_details WHERE bank_ifsc=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$bank_name = $row['bank_name'];
	$bank_state = $row['bank_state'];
	$bank_district = $row['bank_district'];
	$bank_branch = $row['bank_branch'];
	$bank_city = $row['bank_city'];
	$bank_ifsc = $row['bank_ifsc'];
	$bank_micr = $row['bank_micr'];
	$bank_contact = $row['bank_contact'];
	$bank_address = $row['bank_address'];
}

		$string = $ifsc_title;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_description;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pageDescription = str_replace($find, $replace, $string);
        
		$pageKeywords = $bank_ifsc . " IFSC Code, " . $bank_name . " " . $bank_branch . " branch, " . $bank_name . " " . $bank_ifsc . " ," . $bank_name . " " . $bank_district.",";
		
		$string = $ifsc_heading;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $ifsc_keywords;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bank_name", "$bank_state", "$bank_district", "$bank_branch","$bank_ifsc");
		$ifsc_keywords = str_replace($find, $replace, $string);
		
		echo '<title>'. $pageTitle .'</title>';
		
		echo '<meta name="description" content="'.$pageDescription.'">';
		
		echo '<meta name="keywords" content="'.$pageKeywords .'">';
    
}

   $searchTermCC = "";
   
   if(isset($_GET['term']) && !empty($_GET['term'])) {
       $searchTermCC = htmlentities(substr($_GET['term'], 0, 30));
   }
 if(!empty($branchCC)) {

		$ifscCC = ($results[0]['bank_ifsc']);
		$bankcode = substr($ifscCC, 0,4);
		$branchcode = substr($ifscCC, -6);
		$string = $ifsc_title_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$ifscCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_description_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$ifscCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $bankCC . " " . $stateCC . "" . $branchCC . " IFSC Code, " . $bankCC . " " . $branchCC . " IFSC Code, " . $bankCC . " " . $branchCC . "" . $districtCC . " IFSC Code details,";
		
		$string = $ifsc_heading_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$ifscCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$ifscCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$string = $ifsc_keywords_branch;
		$find = array('[bank]', '[state]', '[district]', '[branch]', '[ifsccode]', '[bankcode]', '[branchcode]');
		$replace = array("$bankCC", "$stateCC", "$districtCC", "$branchCC", "$ifscCC", "$bankcode", "$branchcode");
		$branchkeywords = str_replace($find, $replace, $string);
		
		
		$og_photo = $ifsc_photo;
		
        
    } else if(!empty($districtCC)) {
        
        // page title, page description and page keywords when bank, state and district selected
		$string = $ifsc_title_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_description_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$pageDescription = str_replace($find, $replace, $string);
        
        $pageKeywords = $bankCC . " " . $stateCC . " " . $districtCC . " IFSC Code, " . $districtCC . " IFSC Code " . $districtCC . " " . $stateCC . " All Branches list,";
		
		$string = $ifsc_heading_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph_district;
		$find = array('[bank]', '[state]', '[district]');
		$replace = array("$bankCC", "$stateCC", "$districtCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $ifsc_photo;
        
    } else if(!empty($stateCC)) {

		$string = $ifsc_title_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$pageTitle = str_replace($find, $replace, $string);
        
		$string = $ifsc_description_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $bankCC . " " . $stateCC . " IFSc Code, " . $stateCC . " " . $bankCC . " IFSc Code list,";
		
		$string = $ifsc_heading_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph_state;
		$find = array('[bank]', '[state]');
		$replace = array("$bankCC", "$stateCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $ifsc_photo;
        
    } else if(!empty($bankCC)) {
		
        // page title, page description and page keywords when bank selected
		$string = $ifsc_title_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$pageTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_description_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$pageDescription = str_replace($find, $replace, $string);
		
        $pageKeywords = $bankCC . " IFSC Code List, ". $bankCC . " states IFSc Code,";
		
		$string = $ifsc_heading_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$hTitle = str_replace($find, $replace, $string);
		
		$string = $ifsc_paragraph_bank;
		$find = array('[bank]');
		$replace = array("$bankCC");
		$pDescription = str_replace($find, $replace, $string);
		
		$og_photo = $ifsc_photo;
        

    } else if($requestedPage === "ifsc-search") {
    
    // search page title, page description and page keywords
    
    $pageTitle = " Search - ".$searchTermCC." ". $homepageTitle;
    $pageDescription = "Search for bank, branch, address, micr code, contact phone, mobile.";
    $pageKeywords = "search, query, find, lookup";
    
}
?>
<?php require 'header.php'; ?>